import AsyncStorage from '@react-native-community/async-storage';
import { View } from 'native-base'
import React, { Component } from 'react'
import { STORAGE_KEY } from '../global/global';

export default class Meetingschedule extends Component {
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
        
           console.log(this.state.data)
        }

    render() {
        return (
            <View>
                
            </View>
        )
    }
}
