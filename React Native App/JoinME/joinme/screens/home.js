import React, {Component} from 'react';
import {View, Text, FlatList, BackHandler} from 'react-native';
import styles from '../css/css';
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
import { Alert, Animated, Easing } from 'react-native';
import { SafeAreaView } from 'react-native';
import { PRIMARY_COLOR, TEXT_WHITE } from '../assets/colors/colors';
import { ScrollView } from 'react-native';
import Ripple from 'react-native-material-ripple';
import { TouchableOpacity } from 'react-native';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { Spinner } from 'native-base';
import { ToastAndroid } from 'react-native';
import { Platform } from 'react-native';


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

    

     temparr=new Array()
     
     
  
    
    async componentDidMount(){
      if (Platform.OS === 'android'){
        BackHandler.addEventListener('hardwareBackPress', this.onBackAndroid);
      }
  
      if(this.state.isRefreshing || this.state.isFooterLoading){
        this.setState({isVisible: false});
    }else{
        this.setState({isVisible: true});
    }
        await AsyncStorage.getItem(STORAGE_KEY).then((value) => {
          this.setState({uid: value})
            this.getAllPosts(value, this.state.page);
        });

        
    }

    componentWillUnmount() {
      if (Platform.OS === 'android') {
        BackHandler.removeEventListener('hardwareBackPress', this.onBackAndroid);
      }
    }
  
    onBackAndroid = () => {
      // disable return key
           if (this.props.navigation.isFocused ()) {// determines whether the page is in a focused state
          if (this.lastBackPressed && this.lastBackPressed + 2000 >= Date.now()) {
                       // recently pressed the back button within 2 seconds, you can exit the application.
            // return false;
                       BackHandler.exitApp (); // exit APP
          }else{
            this.lastBackPressed = Date.now();
                       ToastAndroid.show ( 'press again to exit the application', 1000); // Tips
            return true;
          }
      }
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
        if(this.state.isRefreshing){
          this.setState({datasource: []})
        }
          if(json.status === 200){
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
          }else{
            this.setState({isVisible: false,
              isRefreshing: false,
              isVisible: false,
              isFooterLoading: false,
              datasource: []
             })
          }

        // json.data.map((each) => {

        // })

      })
      // Next, interpolate beginning and end values (in this case 0 and 1)

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
          if(this.state.currentCount == this.state.minCount && this.state.totalCount != this.state.currentCount && !this.state.isFooterLoading){
        await this.setState({isFooterLoading: true});
            this.getAllPosts(this.state.uid, this.state.page)
    }
      }
       

      
      
      renderItem = ({item, index}) => (
            <Ripple onPress={() => {
            this.props.navigation.navigate('ViewPost', {data: [this.state.datasource[index]], uid: this.state.uid});
          }}>
          <View style={{backgroundColor: 'white'}}>
              <View style={{padding: 15}}>
                  <View style={{flexDirection: 'row'}}>
                  <Text style={{fontSize: 17, marginBottom: 10, fontWeight: 'bold', color: PRIMARY_COLOR}}>{item.ptitle.toUpperCase()}</Text>
                  </View>
                  <Text style={{color: 'gray', fontWeight: 'bold', marginBottom: 5}}>Developers needed</Text>
                  <ScrollView><View style={{flex: 1, flexDirection: 'row'}}>
                  {
                  this.temparr=[],
                  item.skills.skill.map((_eachItem,_eachIndex)=>{
                    if(!this.temparr.includes(_eachItem)){
                      this.temparr.push(_eachItem);
                      // console.log("_eachItem: ",_eachItem);
                      return <TouchableOpacity style={{color: 'white', backgroundColor: PRIMARY_COLOR, margin: 5, paddingLeft: 10, paddingRight: 10, paddingTop: 5, paddingBottom: 5, borderRadius: 50}} key={_eachIndex} onPress={console.log(_eachItem)}><Text style={{color: 'white'}}>{_eachItem}</Text></TouchableOpacity>
                    }
                  })
                  }
                  </View></ScrollView>
                  <View style={{flexDirection: 'row', marginTop: 10, marginBottom: 10, justifyContent: 'space-between'}}>
                  <View style={{flexDirection: 'column', marginTop: 10, marginBottom: 10, width: '40%', borderWidth: 1, borderColor: '#eee', borderRadius: 5, justifyContent: 'center', paddingTop: 10, paddingBottom: 10}}>
                    <Text style={{textAlign: 'center', fontWeight: 'bold', fontSize: 13}}>{item.cname.toUpperCase()}</Text>
                    <Text style={{textAlign: 'center', color: 'gray'}}>Company</Text>
                  </View>
                  <View style={{flexDirection: 'column', marginTop: 10, marginBottom: 10, width: '40%', borderWidth: 1, borderColor: '#eee', borderRadius: 5, justifyContent: 'center', paddingTop: 10, paddingBottom: 10}}>
                    <Text style={{textAlign: 'center', fontWeight: 'bold', fontSize: 13}}>{moment(item.edate).format('Do MMMM YYYY')}</Text>
                    <Text style={{textAlign: 'center', color: 'gray'}}>End date</Text>
                  </View>
                  </View>
                  
            
              </View>
              <View style={{flex: 1, height: 1, backgroundColor: '#D3D3D3'}} />
          </View>
          </Ripple>
      )
    render(){
      
        
        if(this.state.isVisible){
          return (
              <Loading isVisible={this.state.isVisible} />
          )
      }

      if(this.state.datasource != 0){
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
            </SafeAreaView>
        );
              }else{
                if(this.state.totalCount == 0 && this.state.currentCount == 0 || this.state.datasource.length == 0){
                  return(
                    !this.state.isVisible ? (
                      <View style={{alignItems: 'center', justifyContent: 'center', height: '100%'}}>
                          <Ionicons name={'file-tray-outline'} color={'gray'} size={30} />
                          <Text style={{ fontWeight: 'bold', color: 'gray'}}>No data found</Text>
                          <TouchableOpacity style={{backgroundColor: PRIMARY_COLOR, padding: 10, borderRadius: 500, marginTop: 10, flexDirection: 'row'}} onPress={async () => {
                            await this.setState({ isVisible: true });
                            this.getAllPosts(this.state.uid, 0)
                          }}><Text style={{color: TEXT_WHITE}}>Refresh</Text><Ionicons name={'refresh-outline'} color={'white'} size={20} style={{marginStart: 5}} /></TouchableOpacity>
                      </View> ) : (<Loading isVisible={this.state.isVisible} />)
                  );
              }
              }
    }
}


