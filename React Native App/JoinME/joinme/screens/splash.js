import React, {Component} from 'react';
import {StyleSheet, Image, View, Dimensions, StatusBar, Button, ToastAndroid} from 'react-native';
import SvgComponent from '../components/svgcomponent';
export default class Splash extends Component{
    componentDidMount(){
        setTimeout(() => {
            this.props.navigation.navigate('Login')
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
        backgroundColor: 'white'
    },
    imgview: {
        width: width / 2,
        height: height / 2
    }
})