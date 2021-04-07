import React from 'react';
import { useWindowDimensions } from 'react-native';
import { createDrawerNavigator } from '@react-navigation/drawer';
import BottomNavBar from './bottomnavbar';
import Ionicons from 'react-native-vector-icons/Ionicons';
import MyCurrentWork from './mycurrentwork';
import MyJobRequests from './myjobrequests';
import DrawerContent from '../components/drawercontent';

const Drawer = createDrawerNavigator();

export default function NavigationDrawer() {
  return (
    <Drawer.Navigator drawerContent={props => <DrawerContent {...props} />}>
        <Drawer.Screen name="Home" component={BottomNavBar} options={{headerShown: true, headerTransparent: false, headerStyle: {backgroundColor: '#34495E'}, headerTintColor: 'white', headerTitle: 'JoinME', headerRight: () => <Ionicons name={'options'} size={28} color={'white'} style={{'marginRight': 10}} />}} />
        <Drawer.Screen name="MyCurrentWork" component={MyCurrentWork} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: '#34495E'}}} />
        <Drawer.Screen name="MyJobRequests" component={MyJobRequests} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: '#34495E'}}} />
    </Drawer.Navigator>
  );
}