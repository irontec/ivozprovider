import Typography from '@mui/material/Typography';
import { StyledCard, StyledCardContent, StyledDivContentLeft, StyledLink } from './DashboardLongCard.styles';

const DashboardLongCard = (props: any) => {

  const { menuItem } = props;

  return (
    <StyledCard>
      <div>
        <StyledCardContent>
          <StyledDivContentLeft>
            <StyledLink to={menuItem.path}>
              {menuItem.icon}
              <Typography color="textSecondary" gutterBottom>
                {menuItem.title}
              </Typography>
            </StyledLink>
          </StyledDivContentLeft>
          {props.children}
        </StyledCardContent>
      </div>
    </StyledCard>
  );
};

export default DashboardLongCard;