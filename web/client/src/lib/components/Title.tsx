import Typography from '@mui/material/Typography';

interface TitleProps {
  children: JSX.Element | string
}

export default function Title(props: TitleProps): JSX.Element {
  return (
    <Typography component="h2" variant="h6" color="inherit" gutterBottom>
      {props.children}
    </Typography>
  );
}