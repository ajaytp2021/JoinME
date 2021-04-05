import React from 'react';
// import {StackNavigator} from 'react-navigation'
// import { , } from 'react-navigation-stack';
import 'react-native-gesture-handler';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import Login from './screens/login';
import Splash from './screens/splash';
import Register from './screens/register';
import Home from './screens/home';
import BottomNavBar from './screens/bottomnavbar';
import Profile from './screens/profile';
import AddSkills from './screens/addskills';
import Documents from './screens/documents';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { Alert } from 'react-native';
import { Platform } from 'react-native';

const Stack = createStackNavigator();
const clickMainIcon = () => {
  Alert.alert("Clicked");
}
export default function Application(){
  return(
    <NavigationContainer>
      <Stack.Navigator initialRouteName='Splash'>
        <Stack.Screen name='Splash' component={Splash} options={{headerShown: false, headerTransparent: true}} />
        <Stack.Screen name='Login' component={Login} options={{headerShown: false, headerTransparent: true}} />
        <Stack.Screen name='Register' component={Register} options={{headerShown: true, headerTransparent: true}} />
        <Stack.Screen name='Home' component={Home} options={{headerShown: false, headerTransparent: false}} />
        <Stack.Screen name='BottomNavBar' component={BottomNavBar} options={{headerShown: true, headerTransparent: false, headerStyle: {backgroundColor: '#34495E'}, headerTitleStyle: {color: 'white'}, headerTitle: 'JoinME', headerLeft: () => <Ionicons name={'menu'} size={28} color={'white'} onPress={clickMainIcon} style={{marginStart: 10}} />, headerRight: () => <Ionicons name={'options'} size={28} color={'white'} style={{'marginRight': 10}} />}} />
        <Stack.Screen name='Profile' component={Profile} options={{headerShown: false, headerTransparent: false}} />
        <Stack.Screen name='AddSkills' component={AddSkills} options={{headerShown: false, headerTransparent: false}} />
        <Stack.Screen name='Documents' component={Documents} options={{headerShown: false, headerTransparent: false}} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}
