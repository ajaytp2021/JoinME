import AsyncStorage from '@react-native-community/async-storage';
import React, {Component} from 'react';
import { Alert } from 'react-native';
import { TouchableOpacity } from 'react-native';
import { ScrollView } from 'react-native';
import { Text, View } from 'react-native';
import RadioGroup from 'react-native-radio-button-group';
import { BASE_URL } from '../apiurls/apiURLs';
import { PRIMARY_COLOR, TEXT_WHITE } from '../assets/colors/colors';
import Loading from '../components/loading';
import styles from '../css/css';
import { STORAGE_KEY } from '../global/global';
import ProgressDialog from 'react-native-progress-dialog';
import Ionicons from 'react-native-vector-icons/Ionicons';

export default class AddSkills extends Component{
    constructor(props){
        super(props);
        this.state = {
            uid: 0,
            skillset: [],
            skillList: [],
            addedSkillSet: [],
            skill: '',
            selectedSkill: 0,
            selectedSkillToDelete: 0,
            setId: 0,
            isLoading: false,
            isRefreshing: false,
            isProgress: false,
            height: 0
        }
    }

    async componentDidMount(){
        await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
            this.setState({uid: value})
            })
            var uid = this.state.uid;
        this.fetchSkills({uid})
    }

    render(){
        if(this.state.isLoading){
            return (
                <Loading isVisible={this.state.isLoading} />
            )
        }
        if(this.state.skillList.length != 0){
        return(
            <View style={{flex: 1, padding: 10, flexDirection: 'column'}} onLayout={async (event) => {
                const {height} = event.nativeEvent.layout;
                await this.setState({height: height})
            }}>
                <View style={{borderWidth: 1, borderColor: PRIMARY_COLOR, borderRadius: 10}}>
                    <Text style={{color: TEXT_WHITE, padding: 10, backgroundColor: PRIMARY_COLOR, borderTopLeftRadius: 7, borderTopRightRadius: 7}}>Skills</Text>
                    <View style={{margin: 20, height: this.state.height / 3}}>
                        <ScrollView style={{marginBottom: 10}}>
                <RadioGroup
                style={{padding: 20}}
                vertical
            options={this.state.skillset}
            onChange={async (option) => {
              await this.setState({skill: option.label, selectedSkill: option.skid, setId: option.id})
            }}
            activeButtonId={this.state.setId}
            circleStyle={{ fillColor: 'gray', borderColor: 'gray' }}
            key={this.state.skillset.id}
        />
        </ScrollView>
        <TouchableOpacity style={{backgroundColor: PRIMARY_COLOR, padding: 15, borderRadius: 500}} onPress={() => {
                    Alert.alert(
                        'Alert',
                        'Do you want to add '+this.state.skill,
                        [
                            {
                                text: 'No',
                                style: 'cancel'
                            },
                            {
                                text: 'Yes',
                                onPress: () => {
                                    const uid = this.state.uid;
                                    const skid = this.state.selectedSkill;
                                     this.addskill({uid, skid});
                                }
                            }
                        ]
                    )
                }}>
                    <Text style={{color: TEXT_WHITE, textAlign: 'center'}}>Add skill</Text>
                </TouchableOpacity>      
               
                </View>
                </View>

                <View style={{flex: 2, marginBottom: 10, marginTop: 10, height: this.state.height / 2}}>
                    <Text style={{color: TEXT_WHITE, backgroundColor: PRIMARY_COLOR, padding: 10}}>Added Skills list</Text>
                    <ScrollView>
                    {
                        this.state.addedSkillSet.length != 0 ? this.state.addedSkillSet.map((e, i) => {
                            return (
                                <View style={{borderTopColor: PRIMARY_COLOR, borderLeftWidth: 1, borderRightWidth: 1, borderBottomWidth: 1, borderColor: PRIMARY_COLOR, padding: 20, flexDirection: 'row'}} key={i}>
                                    <Text style={{width: '90%'}}>{i+1}. {e.skill}</Text>
                                    <View style={{width: '10%'}}>
                                        <TouchableOpacity onPress={() => {
                                            const uid = this.state.uid;
                                            const skid = e.SKId;
                                            Alert.alert(
                                                'Alert',
                                                'Do you want to delete?',
                                                [
                                                    {
                                                        text: 'No',
                                                        style: 'cancel'
                                                    },
                                                    {
                                                        text: 'Yes',
                                                        onPress: () => {
                                                            this.deleteSkill({uid, skid})
                                                        }
                                                    }
                                                ]
                                            )
                                        }}>
                                        <Ionicons name={'close-outline'} color={'gray'} size={20} />
                                        </TouchableOpacity>
                                    </View>
                                </View>
                            )
                        }) : (
                        <View style={{borderColor: PRIMARY_COLOR, borderWidth: 1, padding: 20}}><Text style={{textAlign: 'center'}}>No skill added</Text></View>
                        )
                    }
                    </ScrollView>
                </View>
                <ProgressDialog visible={this.state.isProgress} />
            </View>
        );
        }else{
            return(
                <View>
                    <Text>No skills</Text>
                </View>
            );
        }
    }

    fetchSkills = ({uid}) => {
        this.setState({isLoading: true, })
    var apiURL = BASE_URL+'/User/app/api/skills.php';
      var data = {
          'uid': uid
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
      await this.setState({skillList: json.skills, addedSkillSet: json.addedskills})
      }else{
      await this.setState({skillset: []})
      }
      await this.setState({skillset: []})
      json.skills.map(async (e, i) => {
            await i === 0 ? this.setState({skill: e.skill, selectedSkill: e.SKId, setId: i}) : null
          await this.setState({skillset: this.state.skillset.concat({'id': i, 'label': e.skill, 'skid': e.SKId})})
      })
    
      await this.setState({isLoading: false, isRefreshing: false})


    // json.data.map((each) => {
    
    // })
    
    })}

    deleteSkill = ({uid, skid}) => {
        this.setState({isProgress: true, })
    var apiURL = BASE_URL+'/User/app/api/deleteskill.php';
      var data = {
          uid: uid,
          skid: skid 
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
          Alert.alert('Information', json.msg)
          this.fetchSkills({uid})
      }
      await this.setState({isProgress: false})


    // json.data.map((each) => {
    
    // })
    
    })}


    addskill = ({uid, skid}) => {
        this.setState({isProgress: true})
    var apiURL = BASE_URL+'/User/app/api/addskill.php';
      var data = {
          'uid': uid,
          'skid': skid
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
        Alert.alert('Information', json.msg)
          this.fetchSkills({uid})
      }else{
          Alert.alert('Information', json.msg)
      }
    
      await this.setState({isProgress: false})
    // json.data.map((each) => {
    
    // })
    
    })}

}

