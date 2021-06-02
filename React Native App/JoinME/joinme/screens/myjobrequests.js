import AsyncStorage from '@react-native-community/async-storage';
import {Text, View} from 'native-base';
import React, {Component} from 'react';
import {FlatList} from 'react-native';
import {BASE_URL} from '../apiurls/apiURLs';
import {STORAGE_KEY} from '../global/global';
import styles from '../css/css';
import Loading from '../components/loading';
import {TouchableWithoutFeedback} from 'react-native';
import Ionicons from 'react-native-vector-icons/Ionicons';
export default class MyJobRequests extends Component {
  constructor(props) {
    super(props);
    this.state = {
      uid: null,
      datasource: [],
      isRefreshing: false,
      isFooterLoading: false,
      totalCount: 0,
      currentCount: 0,
      minCount: 0,
      page: 0,
    };
  }
  async componentDidMount() {
    await AsyncStorage.getItem(STORAGE_KEY).then(value => {
      this.setState({uid: value});
      console.log('job request --- ' + value);
      this.getJobRequests(this.state.uid, 0);
    });
  }

  handleLoadMore = async () => {
    console.log(this.state.currentCount);
    console.log(this.state.minCount);
    console.log(this.state.isFooterLoading);
    if (
      this.state.currentCount == this.state.minCount &&
      this.state.totalCount != this.state.currentCount &&
      !this.state.isFooterLoading
    ) {
      console.log('isFooterLoaded');
      await this.setState({isFooterLoading: true});
      console.log(this.state.isFooterLoading);
      this.getAllPosts(this.state.uid, this.state.page);
    }
  };

  renderFooter = () => {
    return this.state.isFooterLoading ? (
      <View
        style={{
          width: '100%',
          alignItems: 'center',
          backgroundColor: 'white',
          padding: 10,
        }}>
        <Loading
          isVisible={this.state.isFooterLoading}
          text={'Loading more...'}
        />
      </View>
    ) : null;
  };

  renderItem = ({item, index}) => (
    <View style={{backgroundColor: 'white'}} key={index}>
      <View style={{padding: 15}}>
        <View style={{flexDirection: 'column'}}>
          <Text style={{fontSize: 17, marginBottom: 10, fontWeight: 'bold'}}>
            {item.ptitle.toUpperCase()}
          </Text>
          <Text style={{fontSize: 15, marginBottom: 10, color: 'gray'}}>
            Posted on - {item.postdate}
          </Text>
          <Text style={{fontSize: 15, marginBottom: 10, color: 'gray'}}>
            Requested on - {item.reqdate}
          </Text>
          <Text style={{fontSize: 15, marginBottom: 10, color: 'gray'}}>
            Company - {item.cname}
          </Text>
        </View>

        <View style={{display: 'flex'}}>
          <View style={{right: 0, width: '100%'}}>
            <View
              style={{
                padding: 10,
                borderColor: 'gray',
                flexDirection: 'column',
              }}>
              <Text
                style={{
                  textAlign: 'center',
                  position: 'absolute',
                  right: 0,
                  backgroundColor: item.count == 0 ? '#ffff00' : '#00ff00',
                  alignSelf: 'center',
                  paddingStart: 10,
                  paddingEnd: 10,
                  paddingTop: 5,
                  paddingBottom: 5,
                  borderRadius: 50,
                  fontSize: 10,
                  fontWeight: 'bold',
                }}>
                {item.count == 0 ? 'Noy yet accepted' : 'Accepted'}
              </Text>
            </View>
          </View>
        </View>
      </View>
      <View style={{flex: 1, height: 1, backgroundColor: '#D3D3D3'}} />
    </View>
  );

  getJobRequests(uid, page) {
    // this.refs.loading.show();
    console.log(
      '----' + this.state.isRefreshing + '----' + this.state.isFooterLoading,
    );
    if (this.state.isRefreshing || this.state.isFooterLoading) {
      this.setState({isVisible: false});
    } else {
      this.setState({isVisible: true});
    }

    var apiURL = BASE_URL + '/User/app/api/jobrequests.php';
    var data = {
      uid: uid,
      page: page,
    };
    fetch(apiURL, {
      method: 'post',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    })
      .then(response => response.json())
      .then(json => {
        this.setState({
          isVisible: false,
          page: json.page,
          datasource: this.state.isRefreshing
            ? json.data
            : this.state.datasource.concat(json.data),
          totalCount: json.totalcount,
          currentCount: json.currentcount,
          isRefreshing: false,
          isVisible: false,
          isFooterLoading: false,
          minCount: json.mincount,
        });
        // console.log(json)
        // json.data.map((each) => {

        // })
      });
  }

  render() {
    if (this.state.totalCount == 0 && this.state.currentCount == 0) {
      return !this.state.isVisible ? (
        <View>
          <Text>No data found</Text>
        </View>
      ) : (
        <Loading isVisible={this.state.isVisible} />
      );
    }
    return (
      <View style={styles.root}>
        <FlatList
          data={this.state.datasource}
          renderItem={({item, index}) => this.renderItem({item, index})}
          keyExtractor={(item, index) => index}
          refreshing={this.state.isRefreshing}
          onRefresh={async () => {
            await this.setState({isRefreshing: true});
            this.getJobRequests(this.state.uid, 0);
          }}
          onEndReached={this.handleLoadMore.bind(this)}
          onEndReachedThreshold={0}
          ListFooterComponent={this.renderFooter}
          showsVerticalScrollIndicator={false}
        />
      </View>
    );
  }
}
