import { Text, View } from 'native-base';
import React, {Component} from 'react';
import styles from '../css/css';
import Toolbar from '../components/toolbar';

export default class Documents extends Component{
    render(){
        return(
            <View style={styles.root}>
                <Text>Documents</Text>
            </View>
        );
    }
}