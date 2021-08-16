import { withRouter } from "react-router-dom";
import { useFormik } from 'formik';
import { makeStyles } from '@material-ui/core';
import EntityService from 'services/Entity/EntityService';
import EntityInterface from 'entities/EntityInterface';
import { useFormikType } from 'services/Form/types';
import _ from 'services/Translations/translate';
import withRowData from './withRowData';

interface ViewProps extends EntityInterface {
  entityService: EntityService,
  history:any,
  match:any,
  row: any,
}

const View:any = (props: ViewProps) => {

  const { unmarshaller, row } = props;
  const { View, entityService }: { View: any, entityService: EntityService } = props;

  const classes = useStyles();

  return (
    <div>
      <View classes={classes} {...props} />
    </div>
  )
};

const useStyles = makeStyles((theme: any) => ({
  dropDown: {
    minWidth: '250px'
  }
}));

export default withRouter<any, any>(
  withRowData(View)
);
