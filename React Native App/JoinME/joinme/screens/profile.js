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

export default function Profile({navigation}){
    const logout = async () => {
        await AsyncStorage.getItem(STORAGE_KEY).then(async (value) => {
            if(value){
                <ProgressDialog isvisible={true} />
                await AsyncStorage.removeItem(STORAGE_KEY, (error) => {
                    console.log(error);
                }).then(() => {
                        navigation.navigate('Login');

                    })
            }
        })
    }

    let options = {
        title: 'Select Image',
        customButtons: [
          { name: 'customOptionKey', title: 'Choose Photo from Custom Option' },
        ],
        storageOptions: {
          skipBackup: true,
          path: 'images',
        },
      };

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

    return(
        <View style={styles.root}>
            <View style={styles.profilePadding}>
                <ScrollView>
                <View style={styles.card}>
                <TouchableOpacity onPress={() => {
                    launchImageLibrary(options, ()=>{})
                }}><Image source={{uri : 'https://reactnativecode.com/wp-content/uploads/2018/01/2_img.png'}}
              style={{width: 150, height: 150, borderRadius: 150/2, alignSelf: 'center', marginTop: 10}} /></TouchableOpacity>
              <View style={{padding: 20}}>
                  <Text>Name</Text>
              </View>
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
                          logout()
                      } }
                    ]
                  )} />
                </View>
                </ScrollView>
            </View>
        </View>
    );
}