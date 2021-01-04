import React from 'react';

const Footer = (props) => {
    return (<div className="navbar fixed-bottom footer">
       <div className= "text-left ">
           <a className="footer" href="" >A Propos </a>
           <a className="footer" href="" >Conditions générales </a>
       </div>
        <div className= "text-right">
            &copy; {new Date().getFullYear()} Copyright: Alyz Entertaiment
        </div>

    </div> );
};

export default Footer;
