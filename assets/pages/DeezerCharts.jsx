import React, { useEffect, useState } from 'react';
import ChartTracksAPI from '../services/chartTracksAPI';



const DeezerCharts = props => {

    const [tracks, setChart] = useState([]);
    const [countries, setCountries] = useState([]);
    const [filter, setFilter] = useState({
        country: "de",
        dateSelected: ChartTracksAPI.getPreviousDate()
    });

    const [datesSelect, setDatesSelect] = useState([]);



    const fetchChart = async () => {
        try{
            const data = await ChartTracksAPI.findAllTrackDeezer(filter.dateSelected, filter.country);
            setChart(data);
        } catch(error) {
            console.log(error.response);
        }
    }

    const fetchCharts = async () => {
        try{
            const data = await ChartTracksAPI.findAllCountries();
            setCountries(data);
        } catch(error) {
            console.log(error.response);
        }
    }

    const fetchDates = async () => {
        try{
            const data = await ChartTracksAPI.getAllDates();
            setDatesSelect(data);
        } catch(error) {
            console.log(error.response);
        }
    }

    const handleSubmit = async event => {
        event.preventDefault();
        const apiErrors = {};
        try{
            const data = await ChartTracksAPI.findAllTrackDeezer(filter.dateSelected, filter.country);
            setChart(data);
        }catch(error) {
            console.log(error.response);
        }
    }

    const handleChange = ({currentTarget}) =>{
        const {value,name} = currentTarget;
        setFilter({...filter, [name]: value});

    }

    useEffect(()=>{
        fetchChart();
        fetchCharts();
        fetchDates();
    }, []);

    return (
    <>
        <h1>Top Deezer </h1>

        <form onSubmit={handleSubmit}>
        <label>
          pays :
          <select name="country" value={filter.country} onChange={handleChange}>
          {countries.map((country, index) =>
                <option value={country.id}>{country.name}</option>
            )}
          </select>
        </label>
        <label>
          date :
          <select name="dateSelected" value={filter.dateSelected} onChange={handleChange}>
          <option value="">--Please choose an option--</option>
          {datesSelect.map((dateSelect, index) =>
                <option value={dateSelect.publication_date}>{dateSelect.publication_date}</option>
            )}
          </select>
        </label>
        <input type="submit" value="Envoyer" />
        </form>

        <table className="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th>position</th>
                <th>title</th>
                <th>artist</th>
            </tr>
        </thead>
        <tbody>
            {tracks.map((track, index) =>
                <tr key={index}>
                    <td><img alt="cover" src={track.cover} width="200" height="200"/> </td>
                    <td>{track.position}</td>
                    <td>{track.title}</td>
                    <td>{track.artist}</td>
                </tr>
            )}
        </tbody>
        </table>
    </>
    );



};

export default DeezerCharts;