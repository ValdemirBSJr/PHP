 web 服务器功能。
    它提供了可以选择的多处理模块(MPM)，用来绑定到网络端口上，接受请求，
    以及调度子进程处理请求。</p>

    <p>扩展到这一级别的服务器模块化设计，带来两个重要的好处:</p>

    <ul>
      <li>Apache httpd 能更优雅，更高效率的支持不同的平台。尤其是
      Apache httpd 的 Windows 版本现在更有效率了，因为
      <code class="module"><a href="./mod/mpm_winnt.html">mpm_winnt</a></code> 能使用原生网络特性取代在
      Apache httpd 1.3 中使用的 POSIX 层。它也可以扩展到其它平台
      来使用专用的 MPM。</li>

      <li>Apache httpd 能更好的为有特殊要求的站点定制。例如，要求
      更高伸缩性的站点可以选择使用线程的 MPM，即
      <code class="module"><a href="./mod/worker.html">worker</a></code> 或 <code class="module"><a href="./mod/event.html">event</a></code>；
      需要可靠性或者与旧软件兼容的站点可以使用
      <code class="module"><a href="./mod/prefork.html">prefork</a></code>。</li>
    </ul>

    <p>在用户看来，MPM 很像其它 Apache httpd 模块。主要是区别是，在任何时间，
    必须有一个，而且只有一个 MPM 加载到服务器中。可用的 MPM 列表位于
    <a href="mod/">模块索引页面</a>。</p>

</div><div class="top"><a href="#page-header"><img alt="top" src="./images/up.gif" /></a></div>
<div class="section">
<h2><a name="defaults" id="defaults">默认 MPM</a></h2>

<p>下表列出了不同系统的默认 MPM。如果你不在编译时选择，那么它就是你将要使用的 MPM。</p>

<table class="bordered"><tr><td>Netware</td><td><code class="module"><a href="./mod/mpm_netware.html">mpm_netware</a></code></td></tr>
<tr class="odd"><td>OS/2</td><td><code class="module"><a href="./mod/mpmt_os2.html">mpmt_os2</a></code></td></tr>
<tr><td>Unix</td><td><code class="module"><a href="./mod/prefork.html">prefork</a></code>，<code class="module"><a href="./mod/worker.html">worker</a></code> 或
    <code class="module"><a href="./mod/event.html">event</a></code>，取�