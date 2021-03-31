import React, {Component} from 'react';
import {View, Text, StyleSheet} from 'react-native';

export default class Home extends Component{
    render(){
        return(
            <View style={styles.rootview}>
                <Text>Welcome</Text>
            </View>
        );
    }
}
const styles = StyleSheet.create({
    rootview: {
        flex: 1,
        justifyContent: 'center',
        textAlign: 'center'
    }
});