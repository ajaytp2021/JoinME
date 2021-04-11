import React from 'react';
import { View, Text, StyleSheet } from 'react-native';
import {DrawerContentScrollView, DrawerItem} from '@react-navigation/drawer';
import { Drawer, Caption, Title } from 'react-native-paper';
import Ionicons from 'react-native-vector-icons/Ionicons';
import AsyncStorage from '@react-native-community/async-storage';
import { Alert } from 'react-native';
import { STORAGE_KEY } from '../global/global';
import ProgressDialog from 'react-native-progress-dialog';


export default function DrawerContent(props){
    const logout = async () => {
        await AsyncStorage.getItem(STORAGE_KEY).then(async (value) => {
            if(value){
                <ProgressDialog isvisible={true} />
                await AsyncStorage.removeItem(STORAGE_KEY, (error) => {
                    console.log(error);
                }).then( async () => {
                        await this.props.naviagation.navigate('Login');

                    })
            } 
        })
    }
    return(
        <View style={styles.rootview}>
            <DrawerContentScrollView {...props}>
                <View style={styles.mainhead}>
                    <View style={styles.innerhead}>
                    <Title>Welcome to</Title>
                    <Title>JoinME</Title>
                    </View>
                </View>
                <Drawer.Section style={styles.section}>
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'home-outline'} color={color} size={size} />
                )} label={'Home'} onPress={() => {props.navigation.navigate('Home')}} />
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'briefcase-outline'} color={color} size={size} />
                )} label={'My Current Work'} onPress={() => {props.navigation.navigate('MyCurrentWork')}} />
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'document-text-outline'} color={color} size={size} />
                )} label={'My Job Requests'} onPress={() => {props.navigation.navigate('MyJobRequests')}} />
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'pie-chart-outline'} color={color} size={size} />
                )} label={'Generate Report'} onPress={() => {props.navigation.navigate('MyJobRequests')}} />
                <DrawerItem icon={({color, size}) => (
                    <Ionicons name={'log-out-outline'} color={color} size={size} />
                )} label={'Logout'} onPress={() => logout()} />
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