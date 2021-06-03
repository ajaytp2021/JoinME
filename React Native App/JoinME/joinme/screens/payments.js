import AsyncStorage from '@react-native-community/async-storage';
import { Spinner, Text, View } from 'native-base'
import React, { Component } from 'react'
import { FlatList } from 'react-native';
import { StatusBar } from 'react-native';
import { SafeAreaView } from 'react-native';
import { BASE_URL } from '../apiurls/apiURLs';
import { PRIMARY_COLOR } from '../assets/colors/colors';
import { STORAGE_KEY } from '../global/global';
import moment from 'moment';
import Loading from '../components/loading';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { TouchableOpacity } from 'react-native';


export default class Payments extends Component {
    constructor(props){
        super(props);
        this.state = {
            uid: '',
            data: [],
            isLoading: false,
            isRefreshing: false
        }
    }

    async componentDidMount(){
    await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
    this.setState({uid: value})
    })
    var uid = this.state.uid;
       this.getAllPayments({uid})
       console.log(this.state.data)
    }
    
    

    

    render() {
        if(this.state.isLoading){
            return (
                <Loading isVisible={this.state.isLoading} />
            )
        }
        if(this.state.data.length != 0){
        return (
            <SafeAreaView style={styles.root}>
                <StatusBar animated={true} />
                <FlatList
                data={this.state.data}
                refreshing={this.state.isRefreshing}
                onRefresh={async () => {
                        await this.setState({ isRefreshing: true });
                        var uid = this.state.uid
                        this.getAllPayments({uid})
                }}
                renderItem={({item, index}) => this.renderItem({item, index})}
                keyExtractor={(item, index) => index}
                showsVerticalScrollIndicator={false} />
            </SafeAreaView>
        )
        }else{
            return (
                <View style={{alignItems: 'center', justifyContent: 'center', height: '100%'}}>
                    <Ionicons name={'cash-outline'} color={'gray'} size={30} />
                    <Text style={{ fontWeight: 'bold', color: 'gray'}}>No payments</Text>
                    <TouchableOpacity style={{backgroundColor: PRIMARY_COLOR, padding: 10, borderRadius: 500, marginTop: 10, flexDirection: 'row'}} onPress={async () => {
                      await this.setState({ isRefreshing: true });
                      const uid = this.state.uid;
                      this.getAllPayments({uid});
                    }}><Text>Refresh</Text><Ionicons name={'refresh-outline'} color={'white'} size={20} style={{marginStart: 5}} /></TouchableOpacity>
                </View>
            )
        }
    }

    renderItem = ({item, index}) => (
        <View style={{backgroundColor: 'white'}}>
            <View style={{padding: 15}}>
                <View style={{flexDirection: 'row'}}>
                <Text style={{fontSize: 17, marginBottom: 10, fontWeight: 'bold', color: 'green'}}>{'Payment successful on '+moment(item.paidDate).format('Do MMM YYYY')}</Text>
                </View>
                <Text style={{color: 'gray', fontWeight: 'bold', marginBottom: 5}}>Company name : {item.cname}</Text>
                <Text style={{color: 'gray', fontWeight: 'bold', marginBottom: 5}}>Project : {item.pTitle}</Text>
                <Text style={{color: 'gray', fontWeight: 'bold', marginBottom: 5}}>Payment ID : {item.paymentId}</Text>
            </View>
            <View style={{flex: 1, height: 1, backgroundColor: '#D3D3D3'}} />
        </View>
    )

    getAllPayments = ({uid}) => {
        this.setState({isLoading: true})
    var apiURL = BASE_URL+'/User/app/api/payments.php';
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
    
      await this.setState({isLoading: false, isRefreshing: false})
      console.log(json.data)
    
    // json.data.map((each) => {
    
    // })
    
    })}

    
}





