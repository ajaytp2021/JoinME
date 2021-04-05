import React from 'react';
import {View, Text, TouchableOpacity} from 'react-native';
export default function MoreLessTexportext({ fullText }){
    const [more, setMore] = React.useState(false);
    return (
        <View style={{flexDirection: 'column'}}>
      <Text>
        {!more ? `${fullText.substring(0, 50)}...` : fullText}
      </Text>
      <TouchableOpacity onPress={() => setMore(!more)}>
          <Text style={{color: 'green'}}>{more ? 'less' : 'more'}</Text>
        </TouchableOpacity>
      </View>
    );
  };