import React from 'react';
import { View, Text, StyleSheet } from 'react-native';
import {DrawerContentScrollView, DrawerItem} from '@react-navigation/drawer';
import { Drawer, Caption, Title } from 'react-native-paper';
import Ionicons from 'react-native-vector-icons/Ionicons';
import AsyncStorage from '@react-native-community/async-storage';
import { Alert } from 'react-native';


export default function DrawerContent(props){
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
                    <Ionicons name={'log-out-outline'} color={color} size={size} />
                )} label={'Logout'} onPress={() => {
                    Alert.alert('Logout clicked')
                }} />
            </Drawer.Section>
            </DrawerContentScrollView>
            <Drawer.Section>
                <View style={styles.innerhead}>
                    <Caption>Created by Ajay T P</Caption>
                    <Caption>Regular MCA 2018-21</Caption>
                    <Caption>Reg no.: 12087</Caption>
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