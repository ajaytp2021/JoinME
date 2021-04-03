import AsyncStorage from '@react-native-community/async-storage'
import {STORAGE_KEY} from './global'

var fetchId = () => {
        AsyncStorage.getItem(STORAGE_KEY).then((value) => {
            return value;
          })
}

export {fetchId}