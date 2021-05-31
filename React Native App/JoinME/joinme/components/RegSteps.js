import { View, StyleSheet } from 'react-native';
import React, { Component } from 'react';
import { TextInput } from 'react-native-paper';
import Mybutton from '../components/mybutton';
import MybuttonOutlined from '../components/mybuttonoutlined';
import { Alert } from 'react-native';

class Step extends Component {
  state = {}
  render() {
    return (
      <View>
        {this.props.children}
    {this.props.isFirst ? (<View><Mybutton text={this.props.btnText} onPress={this.props.nextStep} btncolor={'#4827FF'} /></View>) : (<View><MybuttonOutlined text={'Previous'} onPress={this.props.prevClick} btncolor={'#4827FF'} /><Mybutton text={this.props.btnText} onPress={this.props.nextStep} btncolor={'#4827FF'} /></View>)}
      </View>
    )
  }
}



export default class RegSteps extends Component {
  
  state = {
    index: 0
  }
  

  static Step = (props) => <Step {...props} />

  _nextClick = () => {
    if(this.state.index === this.props.children.length - 1){
      console.log(this.props.data)
      var check = true;
      this.props.data.uname ? null : check = false
      this.props.data.pass ? null : check = false
      this.props.data.name ? null : check = false
      this.props.data.gender ? null : check = false
      this.props.data.dob ? null : check = false
      this.props.data.address ? null : check = false
      this.props.data.pincode ? null : check = false
      this.props.data.district ? null : check = false
      this.props.data.state ? null : check = false
      this.props.data.country ? null : check = false
      this.props.data.email ? null : check = false
      this.props.data.phone ? null : check = false
      this.props.data.about ? null : check = false

      if(check){
       Alert.alert(
        "Verify",
        "Do you want to submit?",
        [
          {
            text: "Cancel",
            style: "cancel"
          },
          { text: "OK", onPress: () => {
              Alert.alert('Submitted')
            } 
          }
        ]
      )
      }else{
        Alert.alert('Some field(s) you forgot to fill')
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
            </View>
        )
    }
}
