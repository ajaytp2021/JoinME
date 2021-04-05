import AsyncStorage from '@react-native-community/async-storage';
import React, {Component} from 'react';
import {StyleSheet, Image, View, Dimensions, StatusBar, Button, ToastAndroid} from 'react-native';
import SvgComponent from '../components/svgcomponent';
import { STORAGE_KEY } from '../global/global';

export default class Splash extends Component{
    componentDidMount(){
        setTimeout(() => {
                // if(fetchId != null || fetchId != ''){
                //     this.props.navigation.navigate('BottomNavBar')
                //       }else{
                //     this.props.navigation.navigate('Login')
                //       }
                // Alert.alert(fetchId)
                AsyncStorage.getItem(STORAGE_KEY).then((value) => {
                 value ? this.props.navigation.navigate('BottomNavBar') : this.props.navigation.navigate('Login')
                  })
                
            
        }, 2000);
    }
    render(){
    return(
        <View style={styles.rootview}>
        <StatusBar translucent backgroundColor="transparent" />
           <SvgComponent />
        </View>
    );
}

}


const {width, height} = Dimensions.get('screen');
const styles = StyleSheet.create({
    rootview: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: 'white',
        backgroundColor: '#34495E'
    },
    imgview: {
        width: width / 2,
        height: height / 2
    }
})