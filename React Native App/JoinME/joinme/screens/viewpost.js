import { View, Text } from 'react-native';
import React, {Component} from 'react';
import { StyleSheet } from 'react-native';
import {BASE_URL} from '../apiurls/apiURLs';
import { Alert } from 'react-native';
import { BG_COLOR, PRIMARY_COLOR } from '../assets/colors/colors';
import Mybutton from '../components/mybutton';
import { ScrollView } from 'react-native';
import AnimateLoadingButton from 'react-native-animate-loading-button';
import { LogBox } from 'react-native';
import { Dimensions } from 'react-native';
import moment from 'moment';
import { TouchableOpacity } from 'react-native';
import ProgressDialog from 'react-native-progress-dialog';

export default class ViewPost extends Component{
    
    constructor(props){
        super(props);
        this.state = {
            data: {},
            skills: [],
            skillsId: [],
            tasks: [],
            pid: 0,
            cid: 0,
            uid: null,
            btntitle: '',
            isreq: false,
            onprj: false, 
            isAnim: true,
            selectedIndex: null,
            selectedId: 0,
            isReq: false,
            marginBottom: {marginBottom : 0}
        }
    }


    async componentDidMount(){
        this.loadingButton.showLoading(true);
        const {data, uid} = this.props.route.params;
        await this.setState({data: data[0], skills: data[0].skills.skill, skillsId: data[0].skills.skillid, tasks: data[0].skills.tasks, pid: data[0].pid, cid: data[0].cid, uid: uid});
        LogBox.ignoreAllLogs(true);
        this.reqCheck();
    }
    requestJob = ({uid, cid, pid, selectedId}) => {
        this.setState({isReq: true})
      var apiURL = BASE_URL+'/User/app/api/requestjob.php';
      var data = {
            uid: uid,
            cid: cid,
            pid: pid,
            skid: selectedId
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
          Alert.alert('Information', json.msg);
          this.reqCheck();
      }
      
      await this.setState({isReq: false})
      
      // json.data.map((each) => {
      
      // })
      
      })}

    reqCheck = async () => {
        const apiCheckReq = BASE_URL+'/User/app/api/isrequestjob.php';
        const data = {
            pid: this.state.pid,
            cid: this.state.cid,
            uid: this.state.uid
        }
        fetch(apiCheckReq, {
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
                if(json.onPrj){
                    await this.setState({btntitle: 'Already involved in a project'})
                }else if(json.isReq){
                    await this.setState({btntitle: 'Already requested'}) 
                }else{
                    await this.setState({btntitle: 'Request Job'})
                }
                await this.setState({isreq: json.isReq, onprj: json.onPrj})
                this.loadingButton.showLoading(false);
            }
        })
    }

    async _onPressHandler() {
        if(await this.state.isreq || await this.state.onprj){
            Alert.alert('Information', 'You cannot make this job request');
        }else{
            const {uid, pid, cid, selectedId} = await this.state;
            if(selectedId != 0){
            Alert.alert(
                'Alert', 
                'Do you want to request this job?',
                [
                    {
                        text: 'No',
                        style: 'cancel'
                    },
                    {
                        text: 'Yes',
                        onPress: () => {
            this.requestJob({uid, cid, pid, selectedId})
                        }
                    }
                ])
            }else{
                Alert.alert('Information', 'Please choose your skill to request')
            }
        }
    }
temparr = [];
    render(){      

    return(
        <View style={styles.root}>
            <ScrollView>
                <View style={[styles.card]}>
            <View style={styles.innerView}>
            <Text style={styles.titleView}>{this.state.data.ptitle}</Text>
            </View>
            <View style={styles.innerView}>
                <Text style={styles.otherText}>Company : {this.state.data.cname}</Text>
                <Text style={styles.otherText}>End date : {moment(this.state.data.edate).format('Do MMMM YYYY')}</Text>
                <Text style={[styles.otherText, {color: 'gray', fontWeight: 'bold'}]}>Choose your skill from below</Text>
                  <ScrollView><View style={{flex: 1, flexDirection: 'row'}}>
                      
                  { this.temparr = [],
                  this.state.skills.map((each, index) => {
                      if(!this.temparr.includes(each)){
                        this.temparr.push(each);
                    return (<TouchableOpacity key={this.state.skillsId[index]} onPressIn={async () => {
                        await this.setState({selectedIndex: index, selectedId: this.state.skillsId[index]})
                    }}><Text style={{color: 'white', backgroundColor: this.state.selectedIndex == index ? 'green' : PRIMARY_COLOR, margin: 5, paddingLeft: 10, paddingRight: 10, paddingTop: 5, paddingBottom: 5, borderRadius: 50}}>{each}</Text></TouchableOpacity>)
                      }
                  })}
                  </View></ScrollView>
                </View>
                </View>

                <View style={[styles.innerView, styles.card]}>
                <Text style={styles.desctxt}>Tasks</Text>
                <View style={[styles.borderTasks]}>

                    {
                        this.temparr = [],
                        this.state.skills.map((_each, _index) => {
                            if(!this.temparr.includes(_each)){
                                this.temparr.push(_each);
                            return <View><Text style={styles.section}>{_each}</Text><Text style={styles.item}>&#9679; {this.state.tasks[_index]}</Text></View>
                            }else{
                                return <View><Text style={styles.item}>&#9679; {this.state.tasks[_index]}</Text></View>
                            }
                        })
                    }
                    </View>
                    
                </View>
                <View style={[styles.innerView, styles.card, {...this.state.marginBottom}]}>
                    <Text style={styles.desctxt}>About</Text>
                    <Text style={styles.desc}>{this.state.data.desc}</Text>
                </View>


                
            </ScrollView>
            <View style={styles.loading} onLayout={async (event) => {
                const {x, y, width, height} = event.nativeEvent.layout;
                await this.setState({marginBottom: {marginBottom: height}})
            }}>
                    <AnimateLoadingButton
                        ref={c => (this.loadingButton = c)}
                        width={width}
                        height={50}
                        title={this.state.btntitle}
                        titleFontSize={16}
                        titleColor='white'
                        backgroundColor={PRIMARY_COLOR}
                        borderRadius={0}
                        onPress={this._onPressHandler.bind(this)}
                    />
                    </View>
                    <ProgressDialog visible={this.state.isReq} />
        </View>
    );
}
}
const {width, height} = Dimensions.get('screen');
const styles = StyleSheet.create({
    root: {
        flex: 1,
        height: height,
        backgroundColor: BG_COLOR
    },
    innerView: {
        padding: 10
    },
    titleView: {
        fontWeight: 'bold',
        fontSize: 30,
        color: PRIMARY_COLOR,
        marginBottom: 10
    },
    otherText: {
        fontSize: 16,
        fontWeight: 'bold',
        margin: 2.5,
        color: 'gray'
    },
    about: {
        flexDirection: 'column',
        borderWidth: 1,
        borderColor: 'gray',
        borderRadius: 5,
        padding: 10,
        marginTop: 10
    },
    desctxt: {
        textAlign: 'center',
        fontWeight: 'bold',
        textDecorationLine: 'underline',
        marginBottom: 10
    },desc: {
        margin: 2,
        textAlign: 'center'
    },
    loading: {
        position: 'absolute',
        bottom: 0,
        width: width,
        alignItems: 'center',
        flex: 1,
  justifyContent: 'flex-end',
    },
    card: {
        backgroundColor: 'white',
        marginBottom: 10,
    },
    section: {
        textAlign: 'left',
        padding: 5,
        backgroundColor: PRIMARY_COLOR,
        fontWeight: 'bold',
        color: 'white'
    },
    item: {
        textAlign: 'left',
        padding: 5,
        backgroundColor: 'white'
    },
    borderTasks: {
        borderColor: PRIMARY_COLOR,
        borderWidth: 1
    }

});