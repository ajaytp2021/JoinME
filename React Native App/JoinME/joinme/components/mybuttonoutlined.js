import React, {Component} from 'react';
import {View, Text, StyleSheet, TouchableOpacity} from 'react-native';

export default function MybuttonOutlined({text, onPress, btncolor}){
    return(
        <TouchableOpacity onPress={onPress}>
            <View style={{...styles.button, borderColor: btncolor}}>
                <Text style={styles.text}>
                    {text}
                </Text>
            </View>
        </TouchableOpacity>
    );
}

const styles = StyleSheet.create({
    button: {
        borderColor: '#4827FF',
        borderWidth: 2,
        borderRadius: 4,
        padding: 10,
        paddingVertical: 16,
        marginStart: 20,
        marginEnd: 20,
        marginTop: 20
    },
    text: {
        color: '#4827FF',
        fontWeight: 'bold',
        textTransform: 'uppercase',
        fontSize: 16,
        textAlign: 'center'
    }
})