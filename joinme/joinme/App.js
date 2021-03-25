import React from 'react'
import {Button, Text, View, StyleSheet, Alert, Dimensions} from 'react-native'
import Icon from 'react-native-vector-icons/FontAwesome';
import { Input } from 'react-native-elements';
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
      <View >
        <View style={styles.titleview}>
        <Text style={styles.titlesection}>JoinME</Text>
        <Text style={styles.logintitlesection}>LOGIN</Text>
        <View style={styles.loginview}>
        <Text>Login view here</Text>

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
    alignItems: 'center',
    justifyContent: 'center',
    height: height

  },
  btnSign: {
    fontWeight: 'bold'
  },
  titlesection: {
    fontSize: width / 15,
    fontWeight: 'bold',
    paddingStart: 20,
    paddingEnd: 20,
    paddingTop: 20,
    color: 'white'
  },
  logintitlesection: {
    fontSize: width / 10,
    fontWeight: 'bold',
    padding: 20,
    color: 'white'
  },
  inputbox: {
    width: width / 1.3
  },
  titleview: {
    backgroundColor: 'green',
    height: height,
    paddingTop: height / 3,
  },
  loginview: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: 'red',
    height: height,
    borderTopRightRadius: 75,
    shadowColor: '#000',
  }
})
