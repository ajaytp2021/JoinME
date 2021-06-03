import AsyncStorage from '@react-native-community/async-storage';
import { Button, View } from 'react-native'
import React, { Component } from 'react'
import { StatusBar } from 'react-native';
import { SafeAreaView, Text } from 'react-native';
import Loading from '../components/loading';
import { STORAGE_KEY } from '../global/global';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { TouchableOpacity } from 'react-native';
import { BASE_URL } from '../apiurls/apiURLs';
import { PRIMARY_COLOR } from '../assets/colors/colors';
import moment from 'moment';
import Ripple from 'react-native-material-ripple';
import { Alert } from 'react-native';
import { Linking } from 'react-native';

export default class Meetingschedule extends Component {
    constructor(props){
        super(props);
        this.state = {
            uid: '',
            data: [],
            curDateTime: 0,
            isLoading: false,
            isRefreshing: false
        }
    }

    async componentDidMount(){
        await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
        this.setState({uid: value})
        })
        var uid = this.state.uid;
        this.getMeeting({uid})
           console.log(this.state.data)
        }

    render() {
        console.log(this.state.data)
        if(this.state.isLoading){
            return (
                <Loading isVisible={this.state.isLoading} />
            )
        }
        if(this.state.data.length != 0){
            return (
                <SafeAreaView style={styles.root}>
                    <StatusBar animated={true} />
                    <View style={{padding: 10, alignItems: 'center', justifyContent: 'center', height: '100%'}}>
                        <Text style={{fontWeight: 'bold', fontSize: 25, color: 'gray'}}>{this.state.data.meeting[0].topic}</Text>
                        <Text style={{fontWeight: 'bold', color: 'gray'}}>Meeting ID: {this.state.data.meeting[0].meetingId}</Text>
                        <Text style={{fontWeight: 'bold', color: 'gray'}}>Meeting Password: {this.state.data.meeting[0].password}</Text>
                        <Text style={{fontWeight: 'bold', color: 'gray'}}>Company: {this.state.data.meeting[0].cname}</Text>
                        <Text style={{fontWeight: 'bold', color: 'gray'}}>Meeting scheduled on {moment(this.state.data.meeting[0].startTime).format('Do MM YYYY')}</Text>
                        <Text style={{fontWeight: 'bold', color: 'gray'}}>Time: {moment(this.state.data.meeting[0].startTime).format('hh:mm A')}</Text>
                    <Ripple onPress={() => {
                        var startDate = moment(moment(this.state.data.meeting[0].startTime).format('YYYY-MM-DD hh:mm:ss'));
                        var curDate = moment(moment(this.state.curDateTime).format('YYYY-MM-DD hh:mm:ss'));
                        var diff= startDate.diff(curDate);
                        if(diff<=0){
                            Alert.alert(
                                'Alert',
                                'Do you want to join?',
                                [
                                    {
                                        text: 'No',
                                        style: 'cancel'
                                    },
                                    {
                                        text: 'Yes',
                                        onPress: () => {
                                            Linking.canOpenURL(this.state.data.meeting[0].joinUrl).then((supported) => {
                                                if(supported){
                                                    Linking.openURL(this.state.data.meeting[0].joinUrl);
                                                }else{
                                                    Alert.alert('Information', 'Unable to open this URL');
                                                }
                                            })
                                        } 
                                    }
                                ]

                            )
                        }else{
                            Alert.alert('Information', 'You can join to the meeting only on the time shown above')
                        }
                    }}><TouchableOpacity style={{marginTop: 10, padding: 15, backgroundColor: PRIMARY_COLOR, borderRadius: 500}} onPress={() => {
                        
                    }}>
                        <Text>Join Meeting</Text>
                    </TouchableOpacity></Ripple>
                    </View>
                </SafeAreaView>
            )
            }else{
                return (
                    <View style={{alignItems: 'center', justifyContent: 'center', height: '100%'}}>
                        <Ionicons name={'videocam-outline'} color={'gray'} size={30} />
                        <Text style={{ fontWeight: 'bold', color: 'gray'}}>No Meeting scheduled</Text>
                        <TouchableOpacity style={{backgroundColor: PRIMARY_COLOR, padding: 10, borderRadius: 500, marginTop: 10, flexDirection: 'row'}} onPress={async () => {
                          await this.setState({ isRefreshing: true });
                          const uid = this.state.uid;
                          this.getMeeting({uid});
                        }}><Text>Refresh</Text><Ionicons name={'refresh-outline'} color={'white'} size={20} style={{marginStart: 5}} /></TouchableOpacity>
                    </View>
                )
            }
    }

    getMeeting = ({uid}) => {
        this.setState({isLoading: true, data: []})
    var apiURL = BASE_URL+'/User/app/api/meeting.php';
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
        console.log(json)
      if(json.status === 200){
      await this.setState({data: json.curMeeting, curDateTime: json.curDateTime})
      }else{
      await this.setState({data: []})
      }
    
      await this.setState({isLoading: false, isRefreshing: false})
    
    // json.data.map((each) => {
    
    // })
    
    })}
}
