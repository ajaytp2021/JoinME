import {StyleSheet, Dimensions} from 'react-native';
export default styles = StyleSheet.create({
    root: {
        flex: 1,
        width: width,
        height: height,
    },
    rootsample: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center'
    },
    titlesection: {
        fontSize: width / 10,
        fontWeight: 'bold',
        color: 'white',
        marginStart: 20
      },
      logintitlesection: {
        fontSize: width / 15,
        fontWeight: 'bold',
        paddingTop: 30,
        paddingStart: 20,
        color: 'gray'
      },
      top: {
        flex: 1,
        paddingBottom: 30,
      },
      innertop: {
        backgroundColor: '#0000',
        height: height / 2,
        justifyContent: 'center'
      },
      innerbtm: {
        backgroundColor: '#fff',
        borderTopRightRadius: 40,
        borderTopLeftRadius: 40,
        height: height,
        elevation: 20
    
      },
      btm: {
        backgroundColor: '#0000',
        flex: 2
      },
      bgimg: {
        width: width,
        height: height, 
        position: 'absolute', 
        top: 0, 
        left: 0 
      },
      txtshadow: {
        textShadowColor: 'rgba(0, 0, 0, 0.75)',
        textShadowOffset: {width: -1, height: 1},
        textShadowRadius: 10
      },
      inputalign: {
        marginStart: 20,
        marginEnd: 20,
        marginTop: 10
      },
      info: {
        fontWeight: 'bold',
        color: 'gray',
        marginStart: 20,
        marginTop: 5,
        marginBottom: 5
      },
      profilePadding: {
          padding: 10
      },
      card: {
          borderColor: 'gray',
          borderWidth: 1,
          padding: 10,
          borderRadius: 5
      },
      toolbarview: {
        width: width,
          height: 100,
          backgroundColor: 'tomato',
      },
      toolbar: {
          position: 'absolute',
          bottom: 0,
          
          flexDirection: 'row',
          alignItems: 'center',
          elevation: 15,
          marginBottom: 5,

      },
      toolbartitle: {
        marginStart: 10
      }
})
const {width, height} = Dimensions.get("screen")
