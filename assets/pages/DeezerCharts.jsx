import React, { useEffect, useState } from 'react';
import {Helmet} from "react-helmet";
import ChartTracksAPI from '../services/chartTracksAPI';
import "../styles/homepage.css"
import "../styles/chartpage.css"



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
        <div>
            <Helmet>
                <title>Musicalyz - Classement Deezer  </title>
                <meta name="description" content=" Retrouvez sur notre plateforme Musicalyz les derniers classements musicaux de Deezer,les charts par pays" />
                <link rel="image_src" type="image/png" href="/images/banner1.png" />
                <meta name="author" content="Musicalyz" />
                <meta name="keywords" content="Musicalyz tendance Deezer, musicalyz deezer, Top deezer, Classement Deezer, Hit deezer, Tendance deezer, Deezer chart, Top 100 deezer" />
                <meta name="robots" content="all" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />

            </Helmet>

            <h1 className="title_chart_deezer">Les tendances sur Deezer <span><i className="fab fa-deezer"></i></span> </h1>

            <form onSubmit={handleSubmit}>
            <label>
              pays :
              <select class="selectpicker" name="country" value={filter.country} onChange={handleChange}>
              {countries.map((country, index) =>
                    <option value={country.id}>{country.name}</option>
                )}
              </select>
            </label>
            <label>
              date :
              <select class="selectpicker" name="dateSelected" value={filter.dateSelected} onChange={handleChange}>
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
                <tr className="title_group">
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
                        <td className="chart">{track.title}</td>
                        <td className="chart">{track.artist}</td>
                    </tr>
                )}
            </tbody>
                <hr />
            </table>
        </div>
    </>
    );



};

export default DeezerCharts;
