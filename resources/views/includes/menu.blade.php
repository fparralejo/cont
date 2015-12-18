            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informes<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('informes/ultdias/30') }}">Ultimos 30 Días</a></li>
                  <li><a href="{{ URL::asset('informes/ultdias/365') }}">Ultimos 365 Días</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ URL::asset('informes/mesesEjercicio/'.date('Y')) }}">Meses por Años</a></li>
                </ul>            
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gráficas<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('graficas/meses/2000') }}">2000</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2001') }}">2001</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2002') }}">2002</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2003') }}">2003</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2004') }}">2004</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2005') }}">2005</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2006') }}">2006</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2007') }}">2007</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2008') }}">2008</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2009') }}">2009</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2010') }}">2010</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2011') }}">2011</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2012') }}">2012</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2013') }}">2013</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2014') }}">2014</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2015') }}">2015</a></li>
                  <li><a href="{{ URL::asset('graficas/meses/2016') }}">2016</a></li>
                </ul>
            </li>
            <li><a href="{{ URL::asset('logout') }}">Salir</a></li>
