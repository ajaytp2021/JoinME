import { Text, View } from 'native-base';
import React, {Component} from 'react';
import styles from '../css/css';
import Toolbar from '../components/toolbar';
import AsyncStorage from '@react-native-community/async-storage';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { STORAGE_KEY } from '../global/global';
import { PRIMARY_COLOR, TEXT_WHITE } from '../assets/colors/colors';
import Loading from '../components/loading';
import { TouchableOpacity } from 'react-native';
import { BASE_URL } from '../apiurls/apiURLs';
import { Linking } from 'react-native';
import { Alert } from 'react-native';

export default class Documents extends Component{
    constructor(props){
        super(props);
        this.state = {
            uid: '',
            data: [],
            isLoading: false
        }
    }

    async componentDidMount(){
        await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
        this.setState({uid: value})
        })
        var uid = this.state.uid;
        this.fetchDocuments({uid})
        }

    render(){
        if(this.state.isLoading){
            return (
                <Loading isVisible={this.state.isLoading} />
            )
        }
        if(this.state.data.length != 0){
        return(
            <View style={[styles.root, {flexDirection: 'column', justifyContent: 'center'}]}>
                {
                    this.state.data.map((e, i) => {
                        return(
                            <TouchableOpacity style={{margin: 10, borderColor: PRIMARY_COLOR, borderWidth: 1, padding: 20, marginBottom: 10}} onPress={() => {
                                Linking.openURL('http://joinme.ajaytp.in/assets/users/docs/files/'+e.path).catch((e) => {
                                    Alert.alert('Information', 'Could not load file '+e)
                                })
                            }}>
                                <Text style={{textAlign: 'center', fontWeight: 'bold', fontSize: 25}}>Click here to view your {e.type}</Text>
                            </TouchableOpacity>
                        )
                    })
                }
            </View>
        );
        }else{
            return (
                <View style={{alignItems: 'center', justifyContent: 'center', height: '100%'}}>
                    <Ionicons name={'documents-outline'} color={'gray'} size={30} />
                    <Text style={{ fontWeight: 'bold', color: 'gray'}}>No document uploaded</Text>
                    <TouchableOpacity style={{backgroundColor: PRIMARY_COLOR, padding: 10, borderRadius: 500, marginTop: 10, flexDirection: 'row'}} onPress={async () => {
                      await this.setState({ isRefreshing: true });
                      const uid = this.state.uid;
                      this.fetchDocuments({uid});
                    }}><Text style={{color: TEXT_WHITE}}>Refresh</Text><Ionicons name={'refresh-outline'} color={'white'} size={20} style={{marginStart: 5}} /></TouchableOpacity>
                </View>
            )
        }
    }

    fetchDocuments = ({uid}) => {
        this.setState({isLoading: true})
      var apiURL = BASE_URL+'/User/app/api/documents.php';
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
      await this.setState({data: json.data})
      }else{
      await this.setState({data: []})
      }
      
      await this.setState({isLoading: false})
      
      // json.data.map((each) => {
      
      // })
      
      })}
}

