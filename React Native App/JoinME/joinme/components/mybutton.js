import React, {Component} from 'react';
import {View, Text, StyleSheet, TouchableOpacity} from 'react-native';

export default function Mybutton({text, onPress, btncolor}){
    return(
        <TouchableOpacity onPress={onPress}>
            <View style={{...styles.button, backgroundColor: btncolor}}>
                <Text style={styles.text}>
                    {text}
                </Text>
            </View>
        </TouchableOpacity>
    );
}

const styles = StyleSheet.create({
    button: {
        backgroundColor: '#4827FF',
        borderRadius: 4,
        padding: 10,
        paddingVertical: 16,
        marginStart: 20,
        marginEnd: 20,
        marginTop: 20,
        bottom: 0
    },
    text: {
        color: 'white',
        fontWeight: 'bold',
        textTransform: 'uppercase',
        fontSize: 16,
        textAlign: 'center'
    }
})