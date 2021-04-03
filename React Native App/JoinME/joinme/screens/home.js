import React, {Component} from 'react';
import {View, Text, FlatList} from 'react-native';
import styles from '../css/css'
import { StatusBar } from 'react-native';
import ProgressDialog from 'react-native-progress-dialog';
import {BASE_URL} from '../apiurls/apiURLs';
import {STORAGE_KEY} from '../global/global';
import AsyncStorage from '@react-native-community/async-storage';
import { Avatar, Button, Card, Title, Paragraph, Divider } from 'react-native-paper';


export default class Home extends Component{
    constructor(props){
        super(props);
        this.state = {
            isVisible: false,
            uid: null,
            datasource: []
        }
    }
    
    componentDidMount(){
        AsyncStorage.getItem(STORAGE_KEY).then((value) => {
            this.getAllPosts(value)
        });
    }
    getAllPosts(uid){
        // this.refs.loading.show();
        this.setState({isVisible: true})
        
        
          var apiURL = BASE_URL+'/User/app/api/getPosts.php';
          var data = {
                uid: uid
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
          this.setState({isVisible: false, datasource: json.data})
        // json.data.map((each) => {

        // })

      })
      }
      renderItem = ({item}) => (
          <Card style={{marginBottom: 2.5, marginTop: 2.5}}>
              <Card.Content>
                  <View style={{flexDirection: 'row'}}>
                  <Title>{item.ptitle}</Title>
                  <Paragraph style={{textAlign: 'right', flex: 1}}>{item.edate}</Paragraph>
                  </View>
                  <Paragraph>{item.jtitle} - {item.ulevel}</Paragraph>
                  <Paragraph>No.of Employees needed : {item.nousers}</Paragraph>
                  <Paragraph>Company : {item.cname}</Paragraph>
                  <Paragraph>Salary : {item.salary}</Paragraph>
              </Card.Content>
          </Card>
      )
    render(){
        return(
            <View style={styles.root}>
                <StatusBar animated={true} />
                <FlatList
                data={this.state.datasource}
                renderItem={this.renderItem}
                keyExtractor={(item, index) => index} />
                <ProgressDialog visible={this.state.isVisible} />
            </View>
        );
    }
}


