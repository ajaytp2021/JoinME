import { Text, View } from 'native-base';
import React, {Component} from 'react';
import styles from '../css/css';
import Toolbar from '../components/toolbar';

export default class AddSkills extends Component{
    render(){
        return(
            <View style={styles.root}>
                <Toolbar />
                <Text>Add skills</Text>
            </View>
        );
    }
}

