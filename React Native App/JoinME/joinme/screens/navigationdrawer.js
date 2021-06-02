import React from 'react';
import { useWindowDimensions } from 'react-native';
import { createDrawerNavigator } from '@react-navigation/drawer';
import BottomNavBar from './bottomnavbar';
import Ionicons from 'react-native-vector-icons/Ionicons';
import MyCurrentWork from './mycurrentwork';
import MyJobRequests from './myjobrequests';
import DrawerContent from '../components/drawercontent';
import { PRIMARY_COLOR } from '../assets/colors/colors';
import Meetingschedule from './meetingschedule';
import Payments from './payments';

const Drawer = createDrawerNavigator();

export default function NavigationDrawer({props}) {
  return (
    <Drawer.Navigator drawerContent={props => <DrawerContent {...props} />}>
        <Drawer.Screen name="Home" component={BottomNavBar} options={{headerShown: true, headerTransparent: false, headerStyle: {backgroundColor: PRIMARY_COLOR}, headerTintColor: 'white', headerTitle: 'JoinME'}} />
        <Drawer.Screen name="My Current Work" component={MyCurrentWork} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: PRIMARY_COLOR}}} />
        <Drawer.Screen name="My Job Requests" component={MyJobRequests} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: PRIMARY_COLOR}}} />
        <Drawer.Screen name="Meeting schedule" component={Meetingschedule} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: PRIMARY_COLOR}}} />
        <Drawer.Screen name="Payments" component={Payments} options={{headerShown: true, headerTintColor: 'white', headerStyle: {backgroundColor: PRIMARY_COLOR}}} />
    </Drawer.Navigator>
  );
}