import { View, StyleSheet } from 'react-native';
import React, { Component } from 'react';
import { TextInput } from 'react-native-paper';
import Mybutton from '../components/mybutton';
import MybuttonOutlined from '../components/mybuttonoutlined';
import { Alert } from 'react-native';
import { BASE_URL } from '../apiurls/apiURLs';
import ProgressDialog from 'react-native-progress-dialog';
import { ScrollView } from 'react-native';

class Step extends Component {
  state = {}
  render() {
    return (
      <View>
        {this.props.children}
    {this.props.isFirst ? (<ScrollView><Mybutton text={this.props.btnText} onPress={this.props.nextStep} btncolor={'#4827FF'} /></ScrollView>) : (<ScrollView><MybuttonOutlined text={'Previous'} onPress={this.props.prevClick} btncolor={'#4827FF'} /><Mybutton text={this.props.btnText} onPress={this.props.nextStep} btncolor={'#4827FF'} /></ScrollView>)}
      </View>
    )
  }
}



export default class RegSteps extends Component {
  
  state = {
    index: 0,
    isLoading: false
  }
  

  static Step = (props) => <Step {...props} />

  _nextClick = () => {
    if(this.state.index === this.props.children.length - 1){
      console.log(this.props.data)
      var check = true;
      var checkpass = false;
      this.props.data.uname ? null : check = false;
      this.props.data.pass ? null : check = false;
      this.props.data.name ? null : check = false;
      this.props.data.gender ? null : check = false;
      this.props.data.dob ? null : check = false;
      this.props.data.address ? null : check = false;
      this.props.data.pincode ? null : check = false;
      this.props.data.district ? null : check = false;
      this.props.data.state ? null : check = false;
      this.props.data.country ? null : check = false;
      this.props.data.email ? null : check = false;
      this.props.data.phone ? null : check = false;
      this.props.data.about ? null : check = false;
      this.props.data.pass == this.props.data.cpass ? checkpass = true : checkpass = false;
      const navigation = this.props.navigation;

      const { uname, name, pass, gender, dob, address, pincode, district, state, country, email, phone, about} = this.props.data

      if(check){
        if(checkpass){
       Alert.alert(
        "Verify",
        "Do you want to submit?",
        [
          {
            text: "Cancel",
            style: "cancel"
          },
          { text: "OK", onPress: () => {
            this.setState({isLoading: true})
            var apiURL = BASE_URL+'/User/app/api/register.php';
      var data = {
            uname: uname,
            pass: pass,
            name: name,
            gender: gender,
            dob: dob,
            address: address,
            pincode: pincode,
            district: district,
            state: state,
            country: country,
            email: email,
            phone: phone,
            about: about
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
    Alert.alert('Success', json.msg);
    navigation.navigate('Login');
    }else{
      Alert.alert('Message', json.msg);
    }
    this.setState({isLoading: false});
  })
            } 
          }
        ]
      )
      }else{
        Alert.alert('Password mismatch')
      }
      }else{
        Alert.alert('Please check all details', 'Some field(s) you forgot to fill')
      }
    }else{
    this.setState(prevState => ({
      index: prevState.index + 1
    }))
  }
  }

  _prevClick = () => {
    this.setState(prevState => ({
      index: prevState.index - 1
    }))
  }

    render() {
        return (
            <View>
                {React.Children.map(this.props.children, (item, index) => {
                  if(index === this.state.index){
                    return React.cloneElement(item, {
                      curIndex: index,
                      nextStep: this._nextClick,
                      prevClick: this._prevClick,
                      isFirst: index === 0,
                      btnText: this.state.index === this.props.children.length - 1 ? 'Submit' : 'Next'
                    })
                    
                  }
                  return null;
                })}
                <ProgressDialog visible={this.state.isLoading} />
            </View>
        )
    }
}
