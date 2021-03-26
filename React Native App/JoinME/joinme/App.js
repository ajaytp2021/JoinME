import React from 'react'
import {Button, Text, View, StyleSheet, Alert, Dimensions, Image} from 'react-native'
import { TextInput } from 'react-native-paper';
import { StatusBar } from 'react-native';
import Mybutton from './components/mybutton';
import MybuttonOutlined from './components/mybuttonoutlined';

export default class Application extends React.Component{
  constructor(props){
    super()
    
    this.state = {
      isReady: false,
    };
  }
  

  async componentDidMount() {
    this.setState({ isReady: true });
  }
  
  btnClick = () => {
    Alert.alert()
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
        <Image source={require('./assets/bgimg.jpg')} style={styles.bgimg}/>
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
    />
    <TextInput
      label="Password"
      placeholder="Enter password here"
      mode="outlined"
      secureTextEntry={true}
      style={styles.inputalign}
    />
    <Mybutton text="Login" onPress={this.btnClick} btncolor={'#4827FF'} />
    <View style={{marginTop: 20}}>
    <View style={{flexDirection: 'row', alignItems: 'center'}}>
  <View style={{flex: 1, height: 1, backgroundColor: '#eee'}} />
  <View>
    <Text style={{width: 50, textAlign: 'center'}}>OR</Text>
  </View>
  <View style={{flex: 1, height: 1, backgroundColor: '#eee'}} />
</View>
    </View>
    <MybuttonOutlined text="Sign Up" onPress={this.btnClick} btncolor={'#4827FF'} />

    
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
