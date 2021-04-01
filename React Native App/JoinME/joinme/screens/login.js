import React from 'react'
import {Button, Text, View, StyleSheet, Dimensions, Image, Alert, LogBox} from 'react-native'
import { StatusBar } from 'react-native';
import Mybutton from '../components/mybutton';
import MybuttonOutlined from '../components/mybuttonoutlined';
import Linetextline from '../components/linetextline';
import { TextInput } from 'react-native-paper';
import ProgressDialog from 'react-native-progress-dialog';
import {BASE_URL} from '../apiurls/apiURLs';
import {STORAGE_KEY} from '../global/global';
import AsyncStorage from '@react-native-community/async-storage'
import styles from '../css/css'

export default class Login extends React.Component{
  constructor(props){
    super(props)
    
    this.state = {
      isReady: false,
      uname: '',
      pass: '',
      isVisible: false
    };
    
  }


   checkLogin = () =>{
    // this.refs.loading.show();
    this.setState({isVisible: true})
    var uname = this.state.uname || "";
    var pass = this.state.pass || "";
    if(!uname || !pass){
    this.setState({isVisible: false})
      Alert.alert('Alert', 'Please enter the username and password')
    }else{
      var apiURL = BASE_URL+'/User/app/api/login.php';
      var data = {
            uname: uname,
            pass: pass
          }
          
        fetch(apiURL, {
          method: 'post',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
  .then(response => response.json())
  .then((json) => {
    if(json.status === 200){
      const uid = json.data ? json.data.uid : null;
      AsyncStorage.setItem(STORAGE_KEY, uid)
      console.log(json.data.uid)
    this.setState({isVisible: false})
      this.props.navigation.navigate('Home')
    }else{
    this.setState({isVisible: false})
    Alert.alert('Alert', json.msg)
    }
  })

    }
  }
  

   componentDidMount() {
    this.setState({ isReady: true });
    LogBox.ignoreLogs(['Animated: `useNativeDriver`']);
    
  }
  
  registerClick = () => {
    this.props.navigation.push('Register')
  }
  
  render() {
    if (!this.state.isReady) {
      return(
        <View styel={styles.rootView}>
          <Text>Loading....</Text>
        </View>
      );
    }
    return (
      <View style={styles.rootView}>
        <StatusBar translucent backgroundColor="transparent" />
        <Image source={require('../assets/bgimg.jpg')} style={styles.bgimg}/>
        <View style={styles.top}>
          <View style={styles.innertop}>
            <Text style={[styles.titlesection, styles.txtshadow]}>Welcome to</Text>
            <Text style={[styles.titlesection, styles.txtshadow]}>JoinME</Text>
          </View>
        </View>
        <View style={styles.btm}>
        <View style={styles.innerbtm}>
          <Text style={styles.logintitlesection}>Login</Text>
          <Text style={styles.info}>This login portal is only for the employees.</Text>
          <TextInput
      label="Username"
      placeholder="Enter username here"
      mode="outlined"
      style={styles.inputalign}
      color={'#fff'}
      onChangeText={(uname)=>this.setState({uname})}
    />
    <TextInput
      label="Password"
      placeholder="Enter password here"
      mode="outlined"
      secureTextEntry={true}
      style={styles.inputalign}
      onChangeText={(pass)=>this.setState({pass})}
    />
    <Mybutton text="Login" onPress={this.btnClick} btncolor={'#4827FF'} onPress={this.checkLogin} />
    <View style={{marginTop: 20}}>
    <Linetextline text={'OR'} marginStart={20} marginEnd={20} />
    </View>
    <MybuttonOutlined text="Sign Up" onPress={this.registerClick} btncolor={'#4827FF'} />

    
        </View>
        </View>
        <ProgressDialog visible={this.state.isVisible} />
      </View>
    );
  }

}


