import { View, Text } from 'native-base';
import React, {useState} from 'react';
import { ScrollView, Image } from 'react-native';
import styles from '../css/css'
import Toolbar from '../components/toolbar';
import {DrawerItem}from '@react-navigation/drawer';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { STORAGE_KEY } from '../global/global';
import ProgressDialog from 'react-native-progress-dialog';
import AsyncStorage from '@react-native-community/async-storage';
import { Alert } from 'react-native';
import { Divider } from 'react-native-paper';
import { TouchableOpacity } from 'react-native';
import {launchCamera, launchImageLibrary} from 'react-native-image-picker';
import Loading from '../components/loading';
import { BASE_URL } from '../apiurls/apiURLs';
import moment from 'moment';
import { TextInput } from 'react-native-paper';
import Mybutton from '../components/mybutton';

export default class Profile extends React.Component{
    
  constructor(props){
    super(props);
    this.state = {
        uid: '',
        data: [],
        curpass: '',
        newpass: '',
        confirmnewpass: '',
        changepassview: false,
        isLoading: false,
        ischanging: false
    }
}

async componentDidMount(){
  await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
  this.setState({uid: value})
  })
  var uid = this.state.uid;
     this.fetchProfile({uid})
     console.log(this.state.data)
  }
    //   ImagePicker.showImagePicker(options, (response) => {
    //     console.log('Response = ', response);
      
    //     if (response.didCancel) {
    //       console.log('User cancelled image picker');
    //     } else if (response.error) {
    //       console.log('ImagePicker Error: ', response.error);
    //     } else if (response.customButton) {
    //       console.log('User tapped custom button: ', response.customButton);
    //     } else {
    //       const source = { uri: response.uri };
      
    //       // You can also display the image using data:
    //       // const source = { uri: 'data:image/jpeg;base64,' + response.data };
      
    //       this.setState({
    //        filePath: response,
    //        fileData: response.data,
    //        fileUri: response.uri
    //       });
    //     }
    //   });
    render(){
      if(this.state.isLoading){
        return (
            <Loading isVisible={this.state.isLoading} />
        )
    }
    return(
        <View style={styles.root}>
            <View>
                <ScrollView>
                <View style={styles.card}>
                <TouchableOpacity><Image source={{uri : this.state.data.img ? 'http://joinme.ajaytp.in/assets/images/profile_pic/'+this.state.data.img : 'http://joinme.ajaytp.in/assets/images/profile_pic/00100sPORTRAIT_00100_BURST20190418124435239_COVER.jpg'}}
              style={{width: 150, height: 150, borderRadius: 150/2, alignSelf: 'center', marginTop: 10}} /></TouchableOpacity>


              <View style={{padding: 10, flexDirection: 'row'}}>
                  <Text style={[styles.text, {textAlign: 'center'}]}>Name: {this.state.data.name}</Text>
              </View>
              <View style={{padding: 10, flexDirection: 'row', alignContent: 'center'}}>
              <Text style={styles.text}>Dob: {moment(this.state.data.dob).format('Do MMM YYYY')}</Text>
                  <Text style={[styles.text]}>Gender: {this.state.data.gender}</Text>
              </View>
              
                </View>

                <View style={styles.card}>
                  <Text style={styles.viewtitle}>Contact</Text>
                <View style={{padding: 10, flexDirection: 'row'}}>
                  <Text style={[styles.text, {textTransform: 'lowercase'}]}><Text style={styles.text}>Email: </Text>{this.state.data.email}</Text>
                  <Text style={styles.text}>Phone: {this.state.data.phone}</Text>
              </View>
                  </View>

                  <View style={styles.card}>
                  <Text style={styles.viewtitle}>Address</Text>
                <View style={{padding: 10, flexDirection: 'row'}}>
                  <Text style={[styles.text]}><Text style={styles.text}>Address: </Text>{this.state.data.address}</Text>
              </View>
              <View style={{padding: 10, flexDirection: 'row', alignContent: 'center'}}>
              <Text style={styles.text}>Pincode: {this.state.data.pincode}</Text>
                  <Text style={[styles.text]}>District: {this.state.data.district}</Text>
              </View>
              <View style={{padding: 10, flexDirection: 'row', alignContent: 'center'}}>
              <Text style={styles.text}>State: {this.state.data.state}</Text>
                  <Text style={[styles.text]}>Country: {this.state.data.country}</Text>
              </View>
                  </View>

                  <View style={styles.card}>
              <Text style={styles.viewtitle}>About</Text>
              <View style={{padding: 10, flexDirection: 'row'}}>
                  <Text style={[styles.text, {textAlign: 'center'}]}>{this.state.data.about}</Text>
              </View>
              </View>



                <View style={styles.card}>
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'lock-closed-outline'} color={color} size={size} />
                )} label={'Change password'} onPress={async () => {
                  await this.setState({changepassview: !this.state.changepassview})
                  await !this.state.changepassview ? this.setState({curpass: '', newpass: '', confirmnewpass: ''}) : null
                }} />
                {
                  this.state.changepassview ? (<View style={{paddingBottom: 10}}>
                    <TextInput
                      label="Current Password"
                      placeholder="Enter current password here"
                      mode="outlined"
                      secureTextEntry={true}
                      style={styles.inputalign}
                      value={this.state.curpass}
                      onChangeText={(curpass)=>this.setState({curpass: curpass})}
                    />
                    <TextInput
                      label="New Password"
                      placeholder="Enter new password here"
                      mode="outlined"
                      secureTextEntry={true}
                      style={styles.inputalign}
                      value={this.state.newpass}
                      onChangeText={(newpass)=>this.setState({newpass: newpass})}
                    />
                    <TextInput
                      label="Confirm New Password"
                      placeholder="Enter new password again"
                      mode="outlined"
                      secureTextEntry={true}
                      style={styles.inputalign}
                      value={this.state.confirmnewpass}
                      onChangeText={(confirmnewpass)=>this.setState({confirmnewpass: confirmnewpass})}
                    />
                    <Mybutton text={'Change'} onPress={() => {
                      if(!this.state.curpass || !this.state.newpass || !this.state.confirmnewpass){
                        Alert.alert('Alert', 'All fields are necessary')
                      }else{
                        if(this.state.newpass == this.state.confirmnewpass){
                          Alert.alert(
                            'Confirm!',
                            'Do you want to change password?',
                            [
                              {
                                text: 'No',
                                style: 'cancel'
                              },
                              {
                                text: 'Yes',
                                onPress: async () => {
                                  await this.setState({ischanging: true})
                                  const uid = this.state.uid;
                                  const curpass = this.state.curpass;
                                  const newpass = this.state.confirmnewpass;
                                  var apiURL = BASE_URL+'/User/app/api/changepassword.php';
var data = {
      uid: uid,
      curpass: curpass,
      newpass: newpass
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
await this.setState({curpass: '', newpass: '', confirmnewpass: ''})
Alert.alert('Information', json.msg)
}else{
await this.setState({data: []})
Alert.alert('Information', json.msg)
}
this.fetchProfile({uid})
await this.setState({ischanging: false})
console.log(json.data)

// json.data.map((each) => {

// })

})
                                }
                              }
                            ]
                          )
                        }else{
                          Alert.alert('Alert', 'Confirm password does not match')
                        }
                      }
                    }} btncolor={'#4827FF'} />
                    </View>) : null
                }

<ProgressDialog visible={this.state.ischanging} />
                
                </View>


                <View style={styles.card}>
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'log-out-outline'} color={color} size={size} />
                )} label={'Logout'} onPress={() => Alert.alert(
                    "Logout alert",
                    "Do you want to logout?",
                    [
                      {
                        text: "Cancel",
                        style: "cancel"
                      },
                      { text: "OK", onPress: () => {
                          this.logout()
                      } }
                    ]
                  )} />
                </View>
                </ScrollView>
            </View>
        </View>
    );
}



fetchProfile = ({uid}) => {
  this.setState({isLoading: true})
var apiURL = BASE_URL+'/User/app/api/profile.php';
var data = {
      uid: uid,
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
await this.setState({data: json.data[0]})
}else{
await this.setState({data: []})
}

await this.setState({isLoading: false})
console.log(json.data)

// json.data.map((each) => {

// })

})}

logout = async () => {
  await AsyncStorage.getItem(STORAGE_KEY).then(async (value) => {
      if(value){
          <ProgressDialog isvisible={true} />
          await AsyncStorage.removeItem(STORAGE_KEY, (error) => {
              console.log(error);
          }).then(() => {
                  this.props.navigation.navigate('Login');

              })
      }
  })
}

options = {
  title: 'Select Image',
  customButtons: [
    { name: 'customOptionKey', title: 'Choose Photo from Custom Option' },
  ],
  storageOptions: {
    skipBackup: true,
    path: 'images',
  },
};

}