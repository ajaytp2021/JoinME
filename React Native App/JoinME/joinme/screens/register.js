import React from 'react'
import {Button, Text, View, StyleSheet, Dimensions, Image} from 'react-native'
import { StatusBar } from 'react-native';
import Mybutton from '../components/mybutton';
import MybuttonOutlined from '../components/mybuttonoutlined';
import Linetextline from '../components/linetextline';
import { TextInput } from 'react-native-paper';
import { ScrollView } from 'react-native';

export default class Register extends React.Component{
  constructor(props){
    super()
    
    this.state = {
      isReady: false,
      uname: '',
      pass: '',
      cpass: '',
      name: '',
      gender: '',
      dob: ''
    };
  }

    backToLogin = () => {
        this.props.navigation.goBack(null);
  }
  

  async componentDidMount() {
    this.setState({ isReady: true });
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
            <Text style={[styles.titlesection, styles.txtshadow]}>User Registration</Text>
            <Text style={[styles.titlesection, styles.txtshadow]}>JoinME</Text>
          </View>
        </View>
        <View style={styles.btm}>
        <View style={styles.innerbtm}>
          <Text style={styles.logintitlesection}>Register</Text>
          <ScrollView>
    <TextInput
      label="Username"
      placeholder="Enter username here"
      mode="outlined"
      secureTextEntry={false}
      style={styles.inputalign}
      onChangeText={(uname)=>this.setState({uname})}
    />
    <TextInput
      label="Password"
      placeholder="Enter password here"
      mode="outlined"
      secureTextEntry={true}
      style={styles.inputalign}
    />
    <TextInput
      label="Confirm Password"
      placeholder="Enter confirm password here"
      mode="outlined"
      secureTextEntry={true}
      style={styles.inputalign}
    />
    <TextInput
      label="Name"
      placeholder="Enter your name here"
      mode="outlined"
      style={styles.inputalign}
      color={'#fff'}
    />
    <TextInput
      label="Gender"
      mode="outlined"
      style={styles.inputalign}
      color={'#fff'}
    />
    <TextInput
      label="DOB"
      placeholder="Enter your DOB here"
      mode="outlined"
      style={styles.inputalign}
      color={'#fff'}
    />

    <Mybutton text="Sign Up" onPress={this.registerClick} btncolor={'#4827FF'} />
    </ScrollView>


    {/* <View style={{marginTop: 20}}>
    <Linetextline text={'OR'} marginStart={20} marginEnd={20} />
    </View> */}
    {/* <MybuttonOutlined text="Sign In"  btncolor={'#4827FF'} onPress={this.backToLogin} /> */}

    
        </View>
        </View>
          
        
      </View>
    );
  }

}
const {width, height} = Dimensions.get("screen")
const styles = StyleSheet.create({
  rootView: {
    flex: 1,

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
    flex: 0.8,
    paddingBottom: 30,
  },
  innertop: {
    backgroundColor: '#0000',
    height: height / 3,
    justifyContent: 'center'
  },
  innerbtm: {
    backgroundColor: '#fff',
    borderTopRightRadius: 40,
    borderTopLeftRadius: 40,
    height: height,
    bottom: 0,
    elevation: 20

  },
  btm: {
    backgroundColor: '#0000',
    flex: 3
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
