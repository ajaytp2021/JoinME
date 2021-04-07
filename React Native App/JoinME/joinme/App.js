import React from 'react';
// import {StackNavigator} from 'react-navigation'
// import { , } from 'react-navigation-stack';
import 'react-native-gesture-handler';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import Login from './screens/login';
import Splash from './screens/splash';
import Register from './screens/register';
import NavigationDrawer from './screens/navigationdrawer';
import { Alert } from 'react-native';

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
        <Stack.Screen name='NavigationDrawer' component={NavigationDrawer} options={{headerShown: false, headerTintColor: '#34495E'}} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}
