import AsyncStorage from '@react-native-community/async-storage';
import React, {Component} from 'react';
import {StyleSheet, Image, View, Dimensions, StatusBar, Settings, ToastAndroid} from 'react-native';
import SvgComponent from '../components/svgcomponent';
import { STORAGE_KEY } from '../global/global';
                
export default class Splash extends Component{
    constructor(props){
        super(props);
        this.state = {
            uid: null
        }
    }
    
    componentDidMount(){
        setTimeout(() => {
                
                AsyncStorage.getItem(STORAGE_KEY).then((value) => {
                 value ? this.props.navigation.navigate('NavigationDrawer') : this.props.navigation.navigate('Login')
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