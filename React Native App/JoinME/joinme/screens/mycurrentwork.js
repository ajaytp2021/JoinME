import { Text, View } from 'native-base';
import React, { Component } from 'react'
import { TouchableOpacity } from 'react-native';
import { StatusBar } from 'react-native';
import { SafeAreaView } from 'react-native';
import { PRIMARY_COLOR, ROOT_BG, TEXT_WHITE } from '../assets/colors/colors';
import Loading from '../components/loading';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { BASE_URL } from '../apiurls/apiURLs';
import AsyncStorage from '@react-native-community/async-storage';
import { STORAGE_KEY } from '../global/global';
import { ScrollView } from 'react-native';

export default class mycurrentwork extends Component {
    constructor(props){
        super(props);
        this.state = {
            uid: '',
            work: [],
            skill: [],
            tasks: [],
            pending: 0,
            isLoading: false,
            isRefreshing: false
        }
    }

    async componentDidMount(){
        await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
        this.setState({uid: value})
        })
        var uid = this.state.uid;
           this.getCurrentWork({uid})
        }

    render() {
        if(this.state.isLoading){
            return (
                <Loading isVisible={this.state.isLoading} />
            )
        }
        if(this.state.work.length != 0){
            return (
                <SafeAreaView>
                    <StatusBar animated={true} />
                    <ScrollView style={{padding: 10}}>
                    <Text style={{fontWeight: 'bold', fontSize: 25, color: 'gray'}}>{this.state.work[0].ptitle}</Text>
                    <Text style={{fontWeight: 'bold', color: 'gray'}}>Company: {this.state.work[0].cname}</Text>
                    <View style={{flexDirection: 'column', borderWidth: 1, borderColor: PRIMARY_COLOR, padding: 20, marginTop: 10, borderRadius: 10}}>
                        <Text style={{fontWeight: 'bold', color: 'gray', textAlign: 'center', marginBottom: 10, textDecorationLine: 'underline'}}>Skills needed for this project</Text>
                        <Text style={{color: 'white', backgroundColor: PRIMARY_COLOR, margin: 5, paddingLeft: 10, paddingRight: 10, paddingTop: 5, paddingBottom: 5, borderRadius: 50, textAlign: 'center'}}>{this.state.skill[0].skill}</Text>
                        </View>
                        <View style={{borderWidth: 1, borderColor: PRIMARY_COLOR, flexDirection: 'column', marginTop: 20, borderRadius: 10}}>
                            <Text style={{paddingTop: 15, paddingBottom: 15, backgroundColor: PRIMARY_COLOR, textAlign: 'center', fontWeight: 'bold', borderTopLeftRadius: 10, borderTopRightRadius: 10, color: TEXT_WHITE}}>Tasks to complete</Text>
                            <View style={{flexDirection: 'column'}}>
                            {
                                this.state.tasks.length !=0 ?
                                (this.state.tasks.map((e, i) => {
                                    return (<View key={i} style={{borderTopColor: PRIMARY_COLOR, borderTopWidth: 1, borderStyle: 'dotted', padding: 15, flexDirection: 'row', width: '100%'}}>
                                        <Text style={{fontSize: 13, color: 'black', width: '90%'}}>{i+1}. {e.task}</Text>
                                        <Ionicons name={e.status == 1 ? 'checkmark-circle' : 'stopwatch'} color={e.status == 1 ? 'green' : 'gray'} size={20} style={{width: '10%'}} />
                                        </View>
                                    );
                                })) : (<Text style={{fontSize: 13, color: 'black', textAlign: 'center'}}>No tasks assigned</Text>)
                            
                            }
                            </View>
                        </View>
                        {
                        this.state.pending == 0 ? (<View style={{marginTop: 20}}>
                                <Text style={{width: '100%', padding: 20, backgroundColor: PRIMARY_COLOR, color: TEXT_WHITE, textAlign: 'center', borderRadius: 500}}>Your tasks are completed</Text>
                            </View>) : null
        }
                    </ScrollView>
                </SafeAreaView>
            )
            }else{
                return (
                    <View style={{alignItems: 'center', justifyContent: 'center', height: '100%'}}>
                        <Ionicons name={'briefcase-outline'} color={'gray'} size={30} />
                        <Text style={{ fontWeight: 'bold', color: 'gray'}}>No current work</Text>
                        <TouchableOpacity style={{backgroundColor: PRIMARY_COLOR, padding: 10, borderRadius: 500, marginTop: 10, flexDirection: 'row'}} onPress={async () => {
                          await this.setState({ isRefreshing: true });
                          const uid = this.state.uid;
                          this.getCurrentWork({uid});
                        }}><Text style={{color: TEXT_WHITE}}>Refresh</Text><Ionicons name={'refresh-outline'} color={'white'} size={20} style={{marginStart: 5}} /></TouchableOpacity>
                    </View>
                )
            }
    }

    getCurrentWork = ({uid}) => {
        this.setState({isLoading: true})
    var apiURL = BASE_URL+'/User/app/api/currentwork.php';
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
      await this.setState({work: json.work, skill: json.skill, tasks: json.tasks, pending: json.pending})
      }
    
      await this.setState({isLoading: false, isRefreshing: false})
    // json.data.map((each) => {
    
    // })
    
    })}
}
