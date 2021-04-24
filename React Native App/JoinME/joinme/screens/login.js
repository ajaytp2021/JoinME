import React from 'react'
import {Button, Text, View, StyleSheet, Dimensions, Image, Alert, LogBox, BackHandler} from 'react-native'
import { StatusBar } from 'react-native';
import Mybutton from '../components/mybutton';
import MybuttonOutlined from '../components/mybuttonoutlined';
import Linetextline from '../components/linetextline';
import { TextInput } from 'react-native-paper';
import ProgressDialog from 'react-native-progress-dialog';
import {BASE_URL} from '../apiurls/apiURLs';
import {STORAGE_KEY} from '../global/global';
import AsyncStorage from '@react-native-community/async-storage'

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


   checkLogin = async () =>{
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
  .then(async (json) => {
    if(json.status === 200){
      const uid = json.data ? json.data.uid : null;
      await AsyncStorage.setItem(STORAGE_KEY, uid).then(async () => {
        await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
          if(value){
          this.setState({isVisible: false})
        this.props.navigation.navigate('NavigationDrawer')
        }else{
          Alert.alert('error store data');
        }
        })
      })
    
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
    // BackHandler.addEventListener('hardwareBackPress', this.handleBackButton.bind(this));
    
  }

//   handleBackButton(){
//     BackHandler.exitApp();
// }
  
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
      <View style={styles.root}>
        <StatusBar translucent backgroundColor="transparent" />
         <Image source={require('../assets/bgimg.jpg')} style={styles.bgimg}/>
        <View style={styles.top}>
          <View style={styles.innertop}>
            <Text style={styles.titlesection}>Welcome to</Text>
            <Text style={styles.titlesection}>JoinME</Text>
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
const {width, height} = Dimensions.get("screen")
const styles = StyleSheet.create({
  root: {
    flex: 1,
    width: width,
    height: height,
},
rootsample: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center'
},
titlesection: {
    fontSize: width / 10,
    fontWeight: 'bold',
    color: 'white',
    marginStart: 20
  },
  logintitlesection: {
    fontSize: width / 15,
    fontWeight: 'bold',
    paddingTop: 30,
    paddingStart: 20,
    color: 'gray'
  },
  top: {
    flex: 1,
    paddingBottom: 30,
  },
  innertop: {
    backgroundColor: '#0000',
    height: height / 2,
    justifyContent: 'center'
  },
  innerbtm: {
    backgroundColor: '#fff',
    borderTopRightRadius: 40,
    borderTopLeftRadius: 40,
    height: height,
    elevation: 20

  },
  btm: {
    backgroundColor: '#0000',
    flex: 2
  },
  bgimg: {
    width: width,
    height: height, 
    position: 'absolute', 
    top: 0, 
    left: 0 
  },
  txtshadow: {
    textShadowColor: 'rgba(0, 0, 0, 0.75)',
    textShadowOffset: {width: -1, height: 1},
    textShadowRadius: 10
  },
  inputalign: {
    marginStart: 20,
    marginEnd: 20,
    marginTop: 10
  },
  info: {
    fontWeight: 'bold',
    color: 'gray',
    marginStart: 20,
    marginTop: 5,
    marginBottom: 5
  }
})


