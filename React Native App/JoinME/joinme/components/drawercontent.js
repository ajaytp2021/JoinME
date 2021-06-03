import React from 'react';
import { View, AppRegistry, StyleSheet } from 'react-native';
import {DrawerContentScrollView, DrawerItem} from '@react-navigation/drawer';
import { Drawer, Caption, Title } from 'react-native-paper';
import Ionicons from 'react-native-vector-icons/Ionicons';
import AsyncStorage from '@react-native-community/async-storage';
import { Alert } from 'react-native';
import { STORAGE_KEY } from '../global/global';
import ProgressDialog from 'react-native-progress-dialog';
import { NavigationActions } from 'react-navigation';


export default function DrawerContent({navigation, props}){
    return(
        <View style={styles.rootview} >
            <DrawerContentScrollView {...props}>
                <View style={styles.mainhead}>
                    <View style={styles.innerhead}>
                    <Title>Welcome to</Title>
                    <Title>JoinME</Title>
                    </View>
                </View>
                <Drawer.Section style={styles.section} >
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'home-outline'} color={color} size={size} />
                )} label={'Home'} onPress={() => {navigation.navigate('Home')}} />
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'briefcase-outline'} color={color} size={size} />
                )} label={'My Current Work'} onPress={() => {navigation.navigate('My Current Work')}} />
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'document-text-outline'} color={color} size={size} />
                )} label={'My Job Requests'} onPress={() => {navigation.navigate('My Job Requests')}} />
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'videocam-outline'} color={color} size={size} />
                )} label={'Meeting Schedule'} onPress={() => {navigation.navigate('Meeting schedule')}} />
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'cash-outline'} color={color} size={size} />
                )} label={'Payments'} onPress={() => {navigation.navigate('Payments')}} />
            </Drawer.Section>
            </DrawerContentScrollView>
            <Drawer.Section>
                <View style={styles.innerhead}>
                    <Caption>JoinME</Caption>
                </View>
            </Drawer.Section>
            
        </View>
    );
}

const styles = StyleSheet.create({
    rootview: {
        flex: 1
    },
    section: {
        marginBottom: 15,
        borderTopColor: '#f4f4f4',
        borderTopWidth: 1
    },
    mainhead: {
        padding: 10
    },
    innerhead: {
        alignItems: 'center'
    }
});