import React, {Component} from 'react';
import {View, Text} from 'react-native';
import styles from '../css/css'
import Toolbar from '../components/toolbar';
import { StatusBar } from 'react-native';


export default class Home extends Component{
    render(){
        return(
            <View style={styles.root}>
                <StatusBar animated={true} />
                <Toolbar />
                <Text>Welcome</Text>
            </View>
        );
    }
}
