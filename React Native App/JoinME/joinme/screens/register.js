import React from 'react'
import {Button, Text, View, StyleSheet, Dimensions, Image} from 'react-native'
import { StatusBar, Keyboard } from 'react-native';
import { TextInput, RadioButton } from 'react-native-paper';
import { ScrollView } from 'react-native';
import RegSteps from '../components/RegSteps';
import RadioGroup from 'react-native-radio-button-group';
import { TouchableOpacity } from 'react-native';
import { DatePickerModal } from 'react-native-paper-dates';
import Moment from 'moment'

export default class Register extends React.Component{
  constructor(props){
    super(props)
    
    this.state = {
      isReady: false,
      uname: '',
      pass: '',
      cpass: '',
      name: '',
      gender: 'male',
      dob: '',
      address: '',
      pincode: '',
      district: '',
      state: '',
      country: '',
      email: '',
      phone: '',
      genderActiveId: 1,
      contentViewHeight: 0,
      datepicker: false
    };
  }

  

    backToLogin = () => {
        this.props.navigation.goBack(null);
  }
  

  async componentDidMount() {
    this.setState({ isReady: true });
  }


onDismiss = () => {
  this.setState({datepicker: false})
}

onChange = async (v) => {
  await this.setState({datepicker: false, dob: Moment(v.date).format('YYYY-MM-DD')})
}

  
  render() {
    if (!this.state.isReady) {
      return(
        <View styel={styles.rootView}>
          <Text>Loading....</Text>
        </View>
      );
    }
    let genderList = [
      { id: 1, label: 'Male' },
      { id: 2, label: 'Female' },
      { id: 3, label: 'Other' },
      ]
      const date = new Date();
      
      
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
        <View style={styles.btm} onLayout={async (event) => {
          const {x, y, width, height} = event.nativeEvent.layout;
          await this.setState({contentViewHeight: height})
        }}>
        <ScrollView style={styles.innerbtm}>
          <ScrollView>
            <RegSteps data={this.state} navigation={this.props.navigation}>
              <RegSteps.Step>
                <ScrollView>
          <Text style={styles.logintitlesection}>Login information</Text>
                <TextInput
                  label="Username"
                  placeholder="Enter username here"
                  mode="outlined"
                  secureTextEntry={false}
                  style={styles.inputalign}
                  value={this.state.uname}
                  onChangeText={(uname)=>{this.setState({uname: uname}) }}
                />
                <TextInput
                  label="Password"
                  placeholder="Enter password here"
                  mode="outlined"
                  secureTextEntry={true}
                  style={styles.inputalign}
                  value={this.state.pass}
                  onChangeText={(pass)=>this.setState({pass: pass})}
                />
                <TextInput
                  label="Confirm Password"
                  placeholder="Enter confirm password here"
                  mode="outlined"
                  secureTextEntry={true}
                  style={styles.inputalign}
                  value={this.state.cpass}
                  onChangeText={(cpass)=>this.setState({cpass: cpass})}
                />
                <TextInput
                  label="Name"
                  placeholder="Enter your name here"
                  mode="outlined"
                  style={styles.inputalign}
                  color={'#fff'}
                  value={this.state.name}
                  onChangeText={(name)=>this.setState({name: name})}
                />
                <View style={[styles.inputalign, {borderWidth: 1, borderColor: 'black', padding: 10}]}>
                  <Text style={{color: 'gray', marginBottom: 10}}>Gender</Text>
                <RadioGroup
                horizontal
            options={genderList}
            onChange={(option) => {
              this.setState({gender: option.label, genderActiveId: option.id})
            }}
            activeButtonId={this.state.genderActiveId}
            circleStyle={{ fillColor: 'gray', borderColor: 'gray' }}
        />
                 </View>
                 <DatePickerModal
        visible={this.state.datepicker}
        onDismiss={this.onDismiss}
        date={date}
        mode="single"
        onConfirm={this.onChange}
        label="Pick A Date"
      />
      <TouchableOpacity onPress={() => {
        this.setState({datepicker: true})
      }}>
                <TextInput
                  label="DOB"
                  placeholder="Enter your DOB here"
                  mode="outlined"
                  style={styles.inputalign}
                  color={'#fff'}
                  value={this.state.dob}
                  editable={false}
                  onChangeText={(dob)=>this.setState({dob: dob})}
                /></TouchableOpacity>
                            </ScrollView>
                          </RegSteps.Step>

              <RegSteps.Step>
                            <ScrollView>
          <Text style={styles.logintitlesection}>Address</Text>
                            <TextInput
                  label="Address"
                  placeholder="Enter address here"
                  mode="outlined"
                  secureTextEntry={false}
                  style={[styles.inputalign]}
                  value={this.state.address}
                  onChangeText={(address)=>this.setState({address: address})}
                />
                <TextInput
                  label="Pincode"
                  placeholder="Enter pincode here"
                  mode="outlined"
                  keyboardType={'phone-pad'}
                  secureTextEntry={false}
                  style={styles.inputalign}
                  value={this.state.pincode}
                  onChangeText={(pincode)=>this.setState({pincode: pincode})}
                />
                <TextInput
                  label="District"
                  placeholder="Enter district here"
                  mode="outlined"
                  secureTextEntry={false}
                  style={styles.inputalign}
                  value={this.state.district}
                  onChangeText={(district)=>this.setState({district: district})}
                />
                <TextInput
                  label="State"
                  placeholder="Enter state here"
                  mode="outlined"
                  secureTextEntry={false}
                  style={styles.inputalign}
                  value={this.state.state}
                  onChangeText={(state)=>this.setState({state: state})}
                />
                <TextInput
                  label="Country"
                  placeholder="Enter countr here"
                  mode="outlined"
                  secureTextEntry={false}
                  style={styles.inputalign}
                  value={this.state.country}
                  onChangeText={(country)=>this.setState({country: country})}
                />
                </ScrollView>
                
              </RegSteps.Step>

              <RegSteps.Step>
                            <ScrollView>
          <Text style={styles.logintitlesection}>Contact details</Text>
                            <TextInput
                  label="Email"
                  placeholder="Enter email here"
                  mode="outlined"
                  keyboardType={'email-address'}
                  secureTextEntry={false}
                  style={styles.inputalign}
                  value={this.state.email}
                  onChangeText={(email)=>this.setState({email: email})}
                />
                <TextInput
                  label="Phone number"
                  keyboardType={'phone-pad'}
                  placeholder="Enter phone number here"
                  mode="outlined"
                  maxLength={10}
                  secureTextEntry={false}
                  style={styles.inputalign}
                  value={this.state.phone}
                  onChangeText={(phone)=>this.setState({phone: phone})}
                />
                </ScrollView>
              </RegSteps.Step>

              <RegSteps.Step>
                            <View>
                              <ScrollView>
          <Text style={styles.logintitlesection}>About yourself</Text>
                            <TextInput
                  label="About yourself"
                  placeholder="Enter here"
                  mode="outlined"
                  secureTextEntry={false}
                  style={[styles.inputalign, {height: this.state.contentViewHeight / 2}]}
                  value={this.state.about}
                  onChangeText={(about)=>this.setState({about: about})}
                />
                </ScrollView>
                </View>
              </RegSteps.Step>
            </RegSteps>
    </ScrollView>


    
        </ScrollView>
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
