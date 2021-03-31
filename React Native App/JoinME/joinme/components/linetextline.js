import React from 'react';
import {View, Text} from 'react-native';
export default function Linetextline({text, marginStart, marginEnd}){
    return(
        <View style={{flexDirection: 'row', alignItems: 'center', marginStart: marginStart, marginEnd: marginEnd}}>
  <View style={{flex: 1, height: 1, backgroundColor: '#eee'}} />
  <View>
    <Text style={{width: 50, textAlign: 'center'}}>{text}</Text>
  </View>
  <View style={{flex: 1, height: 1, backgroundColor: '#eee'}} />
</View>
    );
}