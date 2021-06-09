import PropTypes from 'prop-types';
import Typography from '@material-ui/core/Typography';

export default function Title(props:any) {
  return (
    <Typography component="h2" variant="h6" color="inherit" gutterBottom>
      {props.children}
    </Typography>
  );
}

Title.propTypes = {
  children: PropTypes.node,
};