import React from 'react';
import {View, Text, ActivityIndicator} from 'react-native';
import { PRIMARY_COLOR } from '../assets/colors/colors';

export default function Loading({isVisible, text}) {
    return(
        <View style={{flex: 1, justifyContent: 'center', alignItems: 'center'}}>
                  <ActivityIndicator
                  size='small'
                visible={isVisible}
                color={PRIMARY_COLOR} />
                  <Text>{text ? text : 'Loading...'}</Text>
                </View>
    );
}