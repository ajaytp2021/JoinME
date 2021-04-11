import React from 'react';
import { useWindowDimensions } from 'react-native';
import { createDrawerNavigator } from '@react-navigation/drawer';
import BottomNavBar from './bottomnavbar';
import Ionicons from 'react-native-vector-icons/Ionicons';
import MyCurrentWork from './mycurrentwork';
import MyJobRequests from './myjobrequests';
import ViewPost from './viewpost';
import Login from './login';
import DrawerContent from '../components/drawercontent';
import { PRIMARY_COLOR } from '../assets/colors/colors';

const Drawer = createDrawerNavigator();

export default function NavigationDrawer() {
  return (
    <Drawer.Navigator drawerContent={props => <DrawerContent {...props} />}>
        <Drawer.Screen name="Home" component={BottomNavBar} options={{headerShown: true, headerTransparent: false, headerStyle: {backgroundColor: PRIMARY_COLOR}, headerTintColor: 'white', headerTitle: 'JoinME', headerRight: () => <Ionicons name={'options'} size={28} color={'white'} style={{'marginRight': 10}} />}} />
        <Drawer.Screen name="MyCurrentWork" component={MyCurrentWork} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: PRIMARY_COLOR}}} />
        <Drawer.Screen name="MyJobRequests" component={MyJobRequests} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: PRIMARY_COLOR}}} />
        <Drawer.Screen name="GenerateReport" component={MyJobRequests} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: PRIMARY_COLOR}}} />
        <Drawer.Screen name="Login" component={Login} options={{headerShown: false, headerTintColor: 'white', headerStyle: {backgroundColor: PRIMARY_COLOR}}} />
    </Drawer.Navigator>
  );
}