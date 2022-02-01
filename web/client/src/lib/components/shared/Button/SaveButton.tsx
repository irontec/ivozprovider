import Button from '@mui/material/Button';
import { styled } from '@mui/styles';
import _ from 'lib/services/translations/translate';

interface SaveButtonProps {
  className: string,
}

const SaveButton = function(props: SaveButtonProps): JSX.Element {

  const { className } = props;

  return (
    <div className={className}>
      <Button variant="contained" type="submit">
        {_('Save')}
      </Button>
    </div>
  );
}

export default styled(SaveButton)(() => {
  return {
    'padding': '20px 10px 10px',
    'display': 'flex',
    'alignItems': 'center',
    '& button': {
      'margin': '0 auto'
    }
  };
})
