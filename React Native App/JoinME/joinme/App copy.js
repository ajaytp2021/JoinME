import { createStackNavigator } from 'react-navigation-stack';
import {createAppContainer} from 'react-navigation'
// import { , } from 'react-navigation-stack';
import Login from './screens/login';
import Splash from './screens/splash';

const AppNavigator = createStackNavigator({
  Splash: {
    screen: Splash,
    navigationOptions: {
      headerShown: false,
      headerTransparent: true
    }
  },
  Login: {
    screen: Login,
    navigationOptions: {
      headerShown: false,
      headerTransparent: true
    }
  },
});

export default createAppContainer(AppNavigator);