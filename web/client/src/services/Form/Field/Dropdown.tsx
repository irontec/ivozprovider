import { withRouter } from "react-router-dom";
import {
  FormControl,
  InputLabel,
  makeStyles,
  MenuItem,
  Select
} from '@material-ui/core';
import EntityInterface from 'entities/EntityInterface';

interface SelectProps extends EntityInterface {
  name: string,
  label: string,
  value:any,
  disabled:boolean,
  onChange: (event: any) => void,
  choices: any
}

const Dropdown = (props: SelectProps) => {

    const { name, label, value, disabled, onChange, choices } = props;
    const classes:any = useStyles();

    return (
      <FormControl className={classes.dropDown}>
        <InputLabel>{label}</InputLabel>
        <Select
            name={name}
            value={value}
            disabled={disabled}
            onChange={onChange}
        >
            {Object.entries(choices).map(([value, label]:[any, any], key: number) => {
                return (<MenuItem value={value} key={key}>{label}</MenuItem>);
            })}
        </Select>
      </FormControl>
    );
};

const useStyles = makeStyles((theme: any) => ({
  dropDown: {
    minWidth: '260px'
  }
}));

export default withRouter<any, any>(Dropdown);
