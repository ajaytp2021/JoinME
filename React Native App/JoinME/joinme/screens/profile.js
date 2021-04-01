import { View, Text } from 'native-base';
import React, {Component} from 'react';
import { ScrollView } from 'react-native';
import styles from '../css/css'
import Toolbar from '../components/toolbar';

export default function Profile(){
    return(
        <View style={styles.root}>
            <Toolbar />
            <View style={styles.profilePadding}>
                <ScrollView>
                <View style={styles.card}>
                    <Text>Title</Text>
                </View>
                </ScrollView>
            </View>
        </View>
    );
}