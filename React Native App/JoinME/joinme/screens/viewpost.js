import { View, Text } from 'react-native';
import React, {Component} from 'react';
import { StyleSheet } from 'react-native';
import {BASE_URL} from '../apiurls/apiURLs';
import { Alert } from 'react-native';
import { PRIMARY_COLOR } from '../assets/colors/colors';
import Mybutton from '../components/mybutton';
import { ScrollView } from 'react-native';

export default class ViewPost extends Component{
    
    constructor(props){
        super(props);
        this.state = {
            data: {},
            pid: 0,
            cid: 0,
            uid: null,
            isVisible: false
        }
    }

    async componentDidMount(){
        console.log('second');
        const {data, uid} = this.props.route.params;
        await this.setState({data: data[0], pid: data[0].pid, cid: data[0].cid, uid: uid});
    }

    render(){
        console.log(this.state.data);
        
        

    return(
        <ScrollView style={styles.root}>
            <View style={styles.innerView}>
            <Text style={styles.titleView}>{this.state.data.ptitle}</Text>
            </View>
            <View style={styles.innerView}>
                <Text style={styles.otherText}>Company : {this.state.data.cname}</Text>
                <Text style={styles.otherText}>{this.state.data.jtitle} - {this.state.data.ulevel}</Text>
                <Text style={styles.otherText}>No.of Employees needed : {this.state.data.nousers}</Text>
                <Text style={styles.otherText}>Salary : {'\u20B9'}{this.state.data.salary}</Text>
                <Text style={styles.otherText}>End date : {this.state.data.edate}</Text>
                <View style={styles.about}>
                <Text style={styles.desctxt}>About</Text>
                <Text style={styles.desc}>{this.state.data.desc}</Text>
                </View>
                <View>
                    <Mybutton text={'Request job'} btncolor={PRIMARY_COLOR} style={{bottom: 0}} />
                </View>
            </View>
            
        </ScrollView>
    );
}
}

const styles = StyleSheet.create({
    root: {
        flex: 1
    },
    innerView: {
        padding: 10
    },
    titleView: {
        fontWeight: 'bold',
        fontSize: 30,
        color: PRIMARY_COLOR,
        marginBottom: 10
    },
    otherText: {
        fontSize: 16,
        fontWeight: 'bold',
        margin: 2.5,
    },
    about: {
        flexDirection: 'column',
        borderWidth: 1,
        borderColor: 'gray',
        borderRadius: 5,
        padding: 10,
        marginTop: 10
    },
    desctxt: {
        textAlign: 'center',
        fontWeight: 'bold',
    },desc: {
        margin: 2,
        textAlign: 'center'
    }

});