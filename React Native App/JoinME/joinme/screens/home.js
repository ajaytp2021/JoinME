import React, {Component} from 'react';
import {View, Text, FlatList, ActivityIndicator} from 'react-native';
import styles from '../css/css'
import { StatusBar } from 'react-native';
import ProgressDialog from 'react-native-progress-dialog';
import {BASE_URL} from '../apiurls/apiURLs';
import {STORAGE_KEY} from '../global/global';
import AsyncStorage from '@react-native-community/async-storage';
import { Avatar, Button, Card, Title, Paragraph, Divider } from 'react-native-paper';
import MoreLessText from '../components/morelesstext'
import Loading from '../components/loading'
import { TouchableWithoutFeedback } from 'react-native';
import moment from 'moment';
import { Alert } from 'react-native';
import { SafeAreaView } from 'react-native';


export default class Home extends Component{
    constructor(props){
        super(props);
        this.state = {
            isVisible: false,
            uid: null,
            page: 0,
            datasource: [],
            isFooterLoading: false,
            enableReloading: true,
            isRefreshing: false,
            totalCount: 0,
            currentCount: 0,
            minCount: 0,
            today: null,
            pdate: null
        }
        this.handleLoadMore = this.handleLoadMore.bind(this);
    }
    
    async componentDidMount(){
      if(this.state.isRefreshing || this.state.isFooterLoading){
        this.setState({isVisible: false});
    }else{
        this.setState({isVisible: true});
    }
        await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
          console.log(value);
          this.setState({uid: value})
            this.getAllPosts(value, this.state.page);
        });
        
    }
    getAllPosts(uid, page){
        // this.refs.loading.show();
        console.log('----'+this.state.isRefreshing+'----'+this.state.isFooterLoading);
        if(this.state.isRefreshing || this.state.isFooterLoading){
            this.setState({isVisible: false});
        }else{
            this.setState({isVisible: true});
        }
        
        
          var apiURL = BASE_URL+'/User/app/api/getPosts.php';
          var data = {
                uid: uid,
                page: page
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
      .then((json) => {
          
          this.setState({isVisible: false,
             page: json.page, 
             datasource: this.state.isRefreshing ? json.data : this.state.datasource.concat(json.data),
             totalCount: json.totalcount,
             currentCount: json.currentcount,
             isRefreshing: false,
             isVisible: false,
             isFooterLoading: false,
             minCount: json.mincount,
             today: moment(json.today).format('YYYY-MM-DD'),
             pdate: moment(json.pdate).format('YYYY-MM-DD')
            })
          console.log(json)
        // json.data.map((each) => {

        // })

      })
      }

      _renderTruncatedFooter = (handlePress) => {
        return (
          <Text style={{color: 'green', marginTop: 5}} onPress={handlePress}>
            Read more
          </Text>
        );
      }
    
      _renderRevealedFooter = (handlePress) => {
        return (
          <Text style={{color: 'green', marginTop: 5}} onPress={handlePress}>
            Show less
          </Text>
        );
      }
    
      _handleTextReady = () => {
        // ...
      }

      renderFooter = () => {
          return(
              this.state.isFooterLoading ? <View style={{width: '100%', alignItems: 'center', backgroundColor: 'white', padding: 10}}><Loading isVisible={this.state.isFooterLoading} text={'Loading more...'} /></View> : null
          );
      }

      actionOnRow = (item) =>{
        Alert.alert('Message', item.jtitle);
      }

      handleLoadMore = async () => {
        
        console.log(this.state.currentCount)
        console.log(this.state.minCount)
        console.log(this.state.isFooterLoading)
          if(this.state.currentCount == this.state.minCount && this.state.totalCount != this.state.currentCount && !this.state.isFooterLoading){
        console.log('isFooterLoaded');
        await this.setState({isFooterLoading: true});
        console.log(this.state.isFooterLoading)
            this.getAllPosts(this.state.uid, this.state.page)
    }
      }

      renderItem = ({item, index}) => (
          <TouchableWithoutFeedback onPress={() => {
            this.props.navigation.navigate('ViewPost', {data: [this.state.datasource[index]], uid: this.state.uid});
          }}>
          <View style={{backgroundColor: 'white'}}>
              <View style={{padding: 15}}>
                  <View style={{flexDirection: 'row'}}>
                  <Text style={{fontSize: 17, marginBottom: 10, fontWeight: 'bold'}}>{item.ptitle}</Text>
                  </View>
                  <Text style={{fontWeight: 'bold', marginBottom:30, color: 'gray'}}>Monthly: {'\u20B9'}{item.salary}</Text>
                  <View style={{flexDirection: 'row'}}>
                  <View style={{flexDirection: 'column', width: '50%'}}>
                    <Text style={{textAlign: 'center', fontWeight: 'bold', color: 'gray'}}>Developers Needed</Text>
                    <Text style={{textAlign: 'center', fontWeight: 'bold', fontSize: 20}}>{item.nousers}</Text>
                  </View>
                  <View style={{flexDirection: 'column', width: '50%'}}>
                      <Text style={{textAlign: 'center', fontWeight: 'bold'}}>{item.ulevel.toUpperCase()}</Text>
                      <Text style={{textAlign: 'center', color: 'gray'}}>Experience Level</Text>
                  </View>
                  </View>
                  <View style={{flexDirection: 'row', marginTop: 10, marginBottom: 10}}>
                  <View style={{flexDirection: 'column', width: '50%', marginTop: 10, marginBottom: 10}}>
                    <Text style={{textAlign: 'center', fontWeight: 'bold', fontSize: 13}}>{item.cname.toUpperCase()}</Text>
                    <Text style={{textAlign: 'center', textAlign: 'center', color: 'gray'}}>Company</Text>
                  </View>
                  <View style={{marginTop: 10, marginBottom: 10, right: 0, width: '50%'}}>
                      <Text style={{textAlign: 'center', backgroundColor: '#DBF1FF', alignSelf: 'center', paddingStart: 10, paddingEnd: 10, paddingTop: 5, paddingBottom: 5, borderRadius: 50, fontSize: 10, fontWeight: 'bold'}}>{item.jtitle}</Text>
                  </View>
                  </View>
                  
                  <MoreLessText fullText={item.desc} />
            
              </View>
              <View style={{flex: 1, height: 1, backgroundColor: '#D3D3D3'}} />
          </View>
          </TouchableWithoutFeedback>
      )
    render(){
        if(this.state.totalCount == 0 && this.state.currentCount == 0){
            return(
              !this.state.isVisible ? (
                <View>
                    <Text>No data found</Text>
                </View> ) : (<Loading isVisible={this.state.isVisible} />)
            );
        }
        return(
            <SafeAreaView style={styles.root}>
                <StatusBar animated={true} />
                <FlatList
                data={this.state.datasource}
                renderItem={({item, index}) => this.renderItem({item, index})}
                keyExtractor={(item, index) => index}
                refreshing={this.state.isRefreshing}
                onRefresh={async () => {
                        await this.setState({ isRefreshing: true });
                        this.getAllPosts(this.state.uid, 0)
                }}
                onEndReached={this.handleLoadMore.bind(this)}
                onEndReachedThreshold={0}
                ListFooterComponent={this.renderFooter}
                showsVerticalScrollIndicator={false} />
                <ProgressDialog visible={this.state.isVisible} />
            </SafeAreaView>
        );
    }
}


