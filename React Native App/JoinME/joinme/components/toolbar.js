import {View, text} from 'react-native';
import React from 'react';
import styles from '../css/css';
import { Button, Text } from 'native-base';
import Ionicons from 'react-native-vector-icons/Ionicons';

export default function Toolbar(){
    return(
        <View style={styles.toolbarview}>
        <View style={styles.toolbar}>
            <Ionicons name={'person'} size={28} color={'white'} />
            <View style={styles.toolbartitle}>
            <Text>JoinME</Text>
            </View>
            </View>
            </View>
    );
}