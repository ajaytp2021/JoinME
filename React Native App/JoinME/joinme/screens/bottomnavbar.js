import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import Home from './home';
import Profile from './profile';
import AddSkills from './addskills';
import Documents from './documents';
import Ionicons from 'react-native-vector-icons/Ionicons';

const Tab = createBottomTabNavigator();

export default function BottomNavBar() {
  return (
        <Tab.Navigator screenOptions={({route}) => ({
          tabBarIcon: ({focused, color, size}) => {
            let iconName;
            if(route.name === 'Home'){
              iconName = focused ? 'md-home' : 'md-home-outline';
            }else if(route.name === 'Skills'){
              iconName = focused ? 'code' : 'code-outline';
            }else if(route.name === 'Documents'){
              iconName = focused ? 'documents' : 'documents-outline';
            }else{
              iconName = focused ? 'person' : 'person-outline';
            }
            return <Ionicons name={iconName} size={size} color={color} />
          }
        })} tabBarOptions={{
          activeTintColor: 'tomato',
          inactiveTintColor: 'gray',
        }}>
        <Tab.Screen name="Home" component={Home} />
        <Tab.Screen name="Skills" component={AddSkills} />
        <Tab.Screen name="Documents" component={Documents} />
        <Tab.Screen name="Profile" component={Profile} />
        </Tab.Navigator>
  )
}